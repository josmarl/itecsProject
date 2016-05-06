<?php

class  ConsultaController extends BaseController {
	private $response;

	public function credEntregadaIndex() {		
		$ambitoDAO= new Ambito();
		$ubigeos=array();
		$usuarios=array();
		$perfil=Session::get('usuario.perfil');
		$ambito=Session::get('usuario.ambito');

		if($perfil==Constants::PROFILE_SUPER || $perfil==Constants::PROFILE_ADMINISTRADOR){
			$usuarioDao=new Usuario();
			$usuarios=$usuarioDao->fetch();
		}else if($perfil==Constants::PROFILE_SUPERVISOR){
			$usuarioDao=new Usuario();
			$usuarios=$usuarioDao->fetch($ambito);
		}else{
			$usuarioDao=new Usuario();
			$usuarios=$usuarioDao->find(Session::get('usuario.userid'));
		}
		if($ambito==Constants::AMBITO_NACION){
			$ambitos=$ambitoDAO->fetch();
		}else{
			$ubigeoDAO = new Ubigeo();
			$ambitos=$ambitoDAO->find($ambito);	
			$ubigeos=$ubigeoDAO->fetch($ambitos->n_ambito_pk);
		}

		return View::make('consulta.credencial_entregada',
			array('usuarios'=>$usuarios,
				'ubigeos'=>$ubigeos,
				'ambitos'=>$ambitos,
				'tipoAmbito'=>Constants::TIPO_AMBITO
				));
	}
	public function credByCargoIndex() {
		$ambitoDAO= new Ambito();
		$ambito=Session::get('usuario.ambito');
		if($ambito==Constants::AMBITO_NACION){
			$ambitos=$ambitoDAO->fetch();
		}else{
			$ambitos=$ambitoDAO->find($ambito);	
		}
		return View::make('consulta.credencial_cargo',
			array('ambitos'=>$ambitos,
				'tipoAmbito'=>Constants::TIPO_AMBITO
				));
	}

    public function buscarMesaIndex() {
        $ambito = new Ambito();
        $perfil=Session::get('usuario.perfil');        
        
        if($perfil==Constants::PROFILE_SUPER || $perfil==Constants::PROFILE_ADMINISTRADOR){                
                $ambitos = $ambito->fetch();                
        }else if($perfil==Constants::PROFILE_SUPERVISOR){
                $ambitos= $ambito->find(Session::get('usuario.ambito'));
        }
        
        return View::make('consulta.buscar_mesa',array('ambitos'=>$ambitos));
    }
	public function credEntregadaLocalIndex() {
		$ambitoDAO= new Ambito();
		$ambito=Session::get('usuario.ambito');
		if($ambito==Constants::AMBITO_NACION){
			$ambitos=$ambitoDAO->fetch();
		}else{
			$ambitos=$ambitoDAO->find($ambito);	
		}
		return View::make('consulta.credencial_entregada_local',array('ambitos'=>$ambitos));
	}

	public function credByAmbitoIndex($tipo) {
		$ambitoDAO= new Ambito();
		$ambito=Session::get('usuario.ambito');
		if($ambito==Constants::AMBITO_NACION){
			$ambitos=$ambitoDAO->fetch();
		}else{
			$ambitos=$ambitoDAO->find($ambito);	
		}

		return View::make('consulta.credencial_mmesa',array('ambitos'=>$ambitos,'tipo'=>$tipo));
	}

	public function credCargo($export=false){
		$this->response = new StdClass();
		$this->response->success=false;
		$this->response->message=Messages::ERROR;
		try{
			$params=(object)Input::all();
			$consultaDAO=new Consulta();
			$this->response->data=$consultaDAO->credByCargo($params);
			//$this->response->data=array_slice ($this->response->data,0,($export?count($this->response->data):Constants::MAX_ROWS));
			if(count($this->response->data)>0){
				$this->response->success=true;
				$this->response->message='';				
			}else{
				$this->response->success=false;
				$this->response->message=Messages::CON_INFO_NOT_FOUND;				
			}
		}catch(Exception  $ex){
			$this->response->success=false;
			$this->response->message=(App::environment()==Constants::ENVIRONMENT_DEV?$ex->getMessage():Messages::ERROR);
		}
		return json_encode($this->response);
	}


	public function credEntregadas($export=false){
		$this->response = new StdClass();
		$this->response->success=false;
		$this->response->message=Messages::ERROR;
		try{
			$params=(object)Input::all();
			if($params->entregada=="true"){
				if(strtotime(str_replace('/', '-', $params->fechaIni))>strtotime(str_replace('/', '-', $params->fechaFin))){
					$this->response->message=Messages::DATES_INCORRECT;	
					$this->response->data=[];
					return json_encode($this->response);	
				}
			}
			
			$consultaDAO=new Consulta();
			$this->response->data=$consultaDAO->credEntregadas($params);
			if(count($this->response->data)>0){
				$this->response->success=true;
				$this->response->message='';				
			}else{
				$this->response->success=false;
				$this->response->message=Messages::CON_INFO_NOT_FOUND;				
			}
		}catch(Exception  $ex){
			$this->response->success=false;
			$this->response->message=(App::environment()==Constants::ENVIRONMENT_DEV?$ex->getMessage():Messages::ERROR);
		}
		return json_encode($this->response);
	}


    public function searchDistrito($export=false) {
    	
        $filtro = (object)Input::all();
        if($filtro->filtroMesas == ''){
            $filtro->filtroMesas = 0;
        }
        switch ($filtro->filtroMesas) {
            case 0:
                $valueRange = 0;
                $filtro->filtroMesas = 6;
                break;
            case 1:
                $valueRange = 0;
                $filtro->filtroMesas = 0;
                break;
            case 2:
                $valueRange = 1;
                $filtro->filtroMesas = 2;
                break;
            case 3:
                $valueRange = 3;
                $filtro->filtroMesas = 6;
                break;
        }
        if($filtro->ambito==0){
        	$filtro->ambito=null;
        }
        $padronDesigancion = new PadronDesignacion();
        $response = $padronDesigancion->searchFiltro($filtro->filtroMesas, $filtro->local,  $valueRange ,($filtro->ambito==0?null:$filtro->ambito));
        //$response = array_slice ($response,0,($export?count($response):Constants::MAX_ROWS));
		$this->response = new StdClass();
        $this->response->data = $response;
		if(count($this->response->data)>0){
			$this->response->success=true;
			$this->response->message='';				
		}else{
			$this->response->success=false;
			$this->response->message=Messages::CON_INFO_NOT_FOUND;				
		}
        return json_encode($this->response);
    }

    
    public function searchMesa() {
    	$n_mesa = Input::get('mesa');
        $padronDesigancion = new PadronDesignacion();
        $ambito=Session::get('usuario.ambito');

        $this->response = new StdClass();
        $response = $padronDesigancion->searchMesa($n_mesa);

		if(trim($n_mesa)!==''){
	        if(isset($response[0]->n_ambito)===true){
	        	if($ambito!=Constants::AMBITO_NACION){
		            if($response[0]->n_ambito===$ambito){
		                $this->response->success = true;
		                $this->response->message = '';
		                $this->response->data = $response;
		            }else{
		                $this->response->success = false;
		                $this->response->message = Messages::MESA_NO_AMBITO;
		                $this->response->data = null; 
		            }
	        	}else{
		                $this->response->success = true;
		                $this->response->message = '';
		                $this->response->data = $response;
	        	}

	        }else{
	            $this->response->success = false;
	            $this->response->message = Messages::CON_INFO_NOT_FOUND;
	            $this->response->data = ''; 
	        }
		}else{
	            $this->response->success = false;
	            $this->response->message = Messages::MESA_EMPTY;
	            $this->response->data = ''; 
		}
            
        return json_encode($this->response);
    }
    public function credEntregLocal($export=false) {

    	$this->response = new stdClass();
    	$this->response->success = false;
    	$this->response->message = Messages::ERROR;
    	$params=(object)Input::all();

    	$consultaDao  = new Consulta();
    	$reporteByLocalDis =  $consultaDao->credEntregadasByLocalDis($params->ambito);
    	$reporteByLocalDis =  array_slice ($reporteByLocalDis,0,($export?count($reporteByLocalDis):Constants::MAX_ROWS));
    	$reporteFinal = array();

    	for ($i = 0; $i < count($reporteByLocalDis); $i++) {
    		$reporteFinal[] = $reporteByLocalDis[$i];
    		$reporteByLocal = $consultaDao->credEntregadasByLocal($params->ambito,$reporteByLocalDis[$i]->c_ubigeo_pk);
    		for ($j = 0; $j < count($reporteByLocal); $j++) {
    			$reporteFinal[] = $reporteByLocal[$j];
    		}
    	}

    	for ($k = 0; $k < count($reporteFinal); $k++) {
    		$porcFormat = (0+str_replace(",",".",$reporteFinal[$k]->porc_entregados));
    		$reporteFinal[$k]->porc_entregados=$porcFormat;
    	}

    	
		if(count($reporteFinal)>0){
			$this->response->data = $reporteFinal;
			$this->response->success=true;
			$this->response->message='';				
		}else{
			$this->response->data = [];
			$this->response->success=false;
			$this->response->message=Messages::CON_INFO_NOT_FOUND;				
		}

    	return json_encode($this->response);
    }


	public function credMiembrosMesa($export=false) {
		$this->response = new stdClass();
		$this->response->success = false;
		$this->response->message = Messages::ERROR;
		$params=(object)Input::all();


		if ($params->opc==1) {
			$reporteCredMiembrosMesaDAO = new Consulta();
			$reporte = $reporteCredMiembrosMesaDAO->credEntregadasByAmbito($params->ambito);
			if(count($reporte)>0){
				$this->response->success = true;
				$this->response->message = '';
				$this->response->data = $reporte;
			}else{
				$this->response->success=false;
				$this->response->message=Messages::CON_INFO_NOT_FOUND;
				$this->response->data = [];
			}

			$this->response->param = Constants::TIPO_AMBITO;
		}else if($params->opc==2){
			$reporteCredMiembrosMesaDAO = new Consulta();
			$reporte = $reporteCredMiembrosMesaDAO->credEntregadasByDistrito($params->ambito);
			if(count($reporte)>0){
				$this->response->success = true;
				$this->response->message = '';
				$this->response->data = $reporte;
			}else{
				$this->response->success=false;
				$this->response->message=Messages::CON_INFO_NOT_FOUND;
				$this->response->data = [];
			}
			$this->response->param = Constants::TIPO_DISTRITO;
		}
		return json_encode($this->response);
	}


    public function buscarMesaExport(){           
		$this->response= json_decode($this->searchDistrito(true));             
		if($this->response->success){
			Excel::create(Constants::REPORT_EST_MESAS, function($excel) {
				$excel->sheet(Constants::REPORT_EST_MESAS, function($sheet) {
					$params=(object)Input::all();
					$params->usuario=Session::get('usuario.username');
                                        $ambito = Ambito::find(Session::get('usuario.ambito'));
					$params->ambito=$ambito->c_alias;                               
					$params->fecha=Carbon::now()->format(Constants::FORMAT_TIME_VIEW);					
					$data=$this->response->data;
					$sheet->loadView('consulta.buscar_mesa_excel',array('data'=>$data,'tipoAmbito'=>Constants::TIPO_AMBITO,'params'=>$params));
                                        $sheet->setColumnFormat(array(
					     'A' => '000000',
					));
				});
			})->export('xlsx');
		}
	}
	public function credMiembrosMesaExport() {
		$this->response = json_decode($this->credMiembrosMesa(true));
		if ($this->response->success) {
			Excel::create($this->response->param == Constants::TIPO_AMBITO ? Constants::REPORT_X_ODPE : Constants::REPORT_X_DISTRITO, function($excel) {
				$excel->sheet($this->response->param == Constants::TIPO_DISTRITO ? Constants::REPORT_X_ODPE : Constants::REPORT_X_DISTRITO, function($sheet) {
                                            $params = (object) Input::all();
                                            $params->usuario=Session::get('usuario.username');
                                            $params->fecha=Carbon::now()->format(Constants::FORMAT_TIME_VIEW);
						
                                            if ($params->ambito !== '0') {
                                            	$ambitoDao = new Ambito();
                                                $params->nombreOdpe = $ambitoDao->findById($params->ambito)->c_alias;
                                            } else{
                                                $params->nombreOdpe = Constants::TEXT_TODOS;
                                            }

                                        if ($params->ambito == 0) {
                                            $params->nombreRepor = Constants::TIPO_DISTRITO;
                                        } else{
                                                if ($params->opc == 1) {
                                                    $params->nombreRepor = Constants::TIPO_AMBITO;
                                                } else if ($params->opc == 2){
                                                   $params->nombreRepor = Constants::TIPO_DISTRITO;
                                                }
                                        }
					$data = $this->response->data;
					$sheet->loadView('consulta.credencial_mmesa_excel', array('data' => $data,'params'=>$params));
				});
			})->export('xlsx');
		}
	}
	public function credEntregadasByLocalExcel() {
		$this->response = json_decode($this->credEntregLocal(true));
		if ($this->response->success) {
			Excel::create(Constants::REPORT_X_LOCAL, function($excel) {
				$excel->sheet(Constants::REPORT_X_LOCAL, function($sheet) {
					$params = (object) Input::all();
                                        $ambitoDao = new Ambito();
					$params->usuario=Session::get('usuario.username');
					$params->fecha=Carbon::now()->format(Constants::FORMAT_TIME_VIEW);
                                            if ($params->ambito !== '0') {
                                                $params->nombreOdpe = $ambitoDao->findById($params->ambito)->c_alias;
                                            } else{
                                                $params->nombreOdpe = 'Todos';
                                            }
					$data = $this->response->data;
					$sheet->loadView('consulta.credencial_entregada_local_excel', array('data' => $data,'params'=>$params));
				});
			})->export('xlsx');
		}
	}
	public function credEntregadasExport(){
		$this->response= json_decode($this->credEntregadas(true));
		if($this->response->success){
			Excel::create(Constants::REPORT_REG_CRED, function($excel) {
				$excel->sheet(Constants::REPORT_REG_CRED, function($sheet) {
					$params=(object)Input::all();
					$params->usuario=Session::get('usuario.username');
					$params->ambito=($params->ambito==='0'?Constants::TEXT_TODOS:Ambito::find($params->ambito)->c_alias);
					$params->fecha=Carbon::now()->format(Constants::FORMAT_TIME_VIEW);
					$data=$this->response->data;
					$sheet->loadView('consulta.credencial_entregada_excel',array('data'=>$data,'tipoAmbito'=>Constants::TIPO_AMBITO,'params'=>$params));
					$sheet->setColumnFormat(array(
						'C' => '000000',
						'B' => '00000000',
						));
				});
			})->export('xlsx');
		}
	}
	public function credCargoExport(){
		$this->response= json_decode($this->credCargo(true));
		if($this->response->success){
			Excel::create(Constants::REPORT_CRED_CARGO, function($excel) {
				$excel->sheet(Constants::REPORT_CRED_CARGO, function($sheet) {
					$params=(object)Input::all();
					$params->usuario=Session::get('usuario.username');
					$params->ambito=($params->ambito==='0'?Constants::TEXT_TODOS:Ambito::find($params->ambito)->c_alias);
					$params->fecha=Carbon::now()->format(Constants::FORMAT_TIME_VIEW);					
					$data=$this->response->data;
					$sheet->loadView('consulta.credencial_cargo_excel',array('data'=>$data,'tipoAmbito'=>Constants::TIPO_AMBITO,'params'=>$params));
				});
			})->export('xlsx');

		}
	}



}
