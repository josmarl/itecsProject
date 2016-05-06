<?php
class CredencialController extends BaseController {
	private $response;
	public function index(){
		$perfil=Session::get('usuario.perfil');
		$eliminar=!($perfil==Constants::PROFILE_OPERADOR); 
		return View::make('credencial.index', array('eliminar'=>$eliminar));
	}

	public function removeCredencial(){
		$this->response = new StdClass();
		$this->response->success=false;
		$this->response->message=Messages::ERROR;
		$perfil=Session::get('usuario.perfil');
		$eliminar=!($perfil==Constants::PROFILE_OPERADOR); 
		try{
			if($eliminar){
				$padronDAO = new PadronDesignacion();
				$dni=Input::get('dni');
				$credencial=$padronDAO->getCredencial($dni);
				$padron=$padronDAO->find($credencial->n_padron_desig_pk);
				$padron->aud_cred_reg_fec=null;
				$padron->aud_cred_reg_user=null;	
				$padron->aud_cred_mod_fec=Carbon::now()->format(Constants::FORMAT_TIME);
				$padron->aud_cred_mod_user=Session::get('usuario.userid');	
				if($padron->save()){
					$this->response->success=true;
					$this->response->message= str_replace('[nombre]',$padron->c_nombres.' '.$padron->c_ape_pat.' '.$padron->c_ape_mat,str_replace('[dni]',$padron->c_num_ele,Messages::CRED_REMOVE_SUCCESS));
				}else{
					$this->response->success=false;
				}
			}else{
				$this->response->success=false;
			}
		}catch(Exception $ex){
			$this->response->success=false;
			$this->response->message=(App::environment()==Constants::ENVIRONMENT_DEV?$ex->getMessage():Messages::ERROR);
		}
		return json_encode($this->response);
	}

	public function searchCredencial(){
		$ambito=Session::get('usuario.ambito');
		$this->response = new StdClass();
		$this->response->success=false;
		$this->response->repeat=false;
		$this->response->message=Messages::ERROR;
		if(Input::get('dni')!==null){
			$dni=Input::get('dni');
			if(trim($dni)===''){
				$this->response->message=Messages::CRED_DNI_EMPTY;
			}else{
				//try{
					$padronDAO = new PadronDesignacion();
					if($ambito==Constants::AMBITO_NACION){
						$credencial=$padronDAO->getCredencial($dni);	
					}else{
						$credencial=$padronDAO->getCredencial($dni,$ambito);	
					}
					if($credencial!==null){
						if($credencial->aud_cred_reg_user==null){
							$padron=$padronDAO->find($credencial->n_padron_desig_pk);
							$padron->aud_cred_reg_fec=Carbon::now()->format(Constants::FORMAT_TIME);
							$padron->aud_cred_reg_user=Session::get('usuario.userid');
							if($padron->save()){
								$this->response->success=true;
								$this->response->message= str_replace('[nombre]',$credencial->c_nombres.' '.$credencial->c_ape_pat.' '.$credencial->c_ape_mat,str_replace('[dni]',$credencial->c_num_ele,Messages::CRED_INSERT_SUCCESS)); 
							}else{
								$this->response->success=false;
							}
						}else{
							$this->response->repeat=true;
							$this->response->success=false;
							$this->response->message= str_replace('[nombre]',$credencial->c_nombres.' '.$credencial->c_ape_pat.' '.$credencial->c_ape_mat,str_replace('[dni]',$credencial->c_num_ele,Messages::CRED_MM_REGISTER));
						}
					}else{
						$this->response->success=false;
						$this->response->message=Messages::CRED_DNI_NOT_FOUND;
					}

			}
		}
		return json_encode($this->response);
	}

	public function getCredenciales(){
		$ambito=Session::get('usuario.ambito');
		$padronDAO = new PadronDesignacion();
		$response=array();
		if($ambito==Constants::AMBITO_NACION){
			$response= $padronDAO->getCredenciales()->toArray();
		}else{
			$response= $padronDAO->getCredenciales($ambito)->toArray();	
		}
		
		return array_slice ($response,0,Constants::MAX_ROWS);
	}
}