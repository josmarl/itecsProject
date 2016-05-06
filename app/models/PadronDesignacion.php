<?php

class PadronDesignacion extends BaseModel {
    protected $table = 'TAB_PADRON_DESIGNACION';
    protected $primaryKey = 'n_padron_desig_pk';
    public $timestamps = false;

    public function __construct() {
        
    }   
   public function getCredencial($dni,$ambito=null){
    	$padron= PadronDesignacion::where('c_num_ele',$dni)->whereNotNull('n_param_cargo_pk')->whereNotIn('n_param_estado', [221,177,125]) ;
      if($ambito!==null){
        $padron->where('n_ambito',$ambito);
      }
      return $padron->first();
   }

   public function getCredenciales($ambito=null){
      $padron= PadronDesignacion::where('n_param_estado',Constants::STATUS_SORTEADO);
      if($ambito!==null){
        $padron->where('n_ambito',$ambito);
      }
      $padron->whereNotNull('aud_cred_reg_fec');
      $padron->orderBy('aud_cred_reg_fec','desc')->get();
      return $padron->get();
   }

   public function searchMesa($mesa){
    	$query = "SELECT d.c_mesa_rec, d.n_ambito
                    , x1.aud_cred_reg_fec AS PRESIDENTE, x2.aud_cred_reg_fec AS SECRETARIO, x3.aud_cred_reg_fec AS TERCER_MIEMBRO, x4.aud_cred_reg_fec AS PRIMER_SUPLENTE, x5.aud_cred_reg_fec AS SEGUNDO_SUPLENTE, x6.aud_cred_reg_fec AS TERCER_SUPLENTE  
                    , (CASE WHEN x1.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x2.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x3.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x4.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x5.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x6.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END) AS ESTADO
                  FROM tab_padron_designacion d
                    INNER JOIN (select c_mesa_rec, n_ambito, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '100') x1 ON x1.n_ambito = d.n_ambito AND x1.c_mesa_rec = d.c_mesa_rec
                    INNER JOIN (select c_mesa_rec, n_ambito, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '101') x2 ON x2.n_ambito = d.n_ambito AND x2.c_mesa_rec = d.c_mesa_rec
                    INNER JOIN (select c_mesa_rec, n_ambito, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '102') x3 ON x3.n_ambito = d.n_ambito AND x3.c_mesa_rec = d.c_mesa_rec
                    INNER JOIN (select c_mesa_rec, n_ambito, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '103') x4 ON x4.n_ambito = d.n_ambito AND x4.c_mesa_rec = d.c_mesa_rec
                    INNER JOIN (select c_mesa_rec, n_ambito, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '104') x5 ON x5.n_ambito = d.n_ambito AND x5.c_mesa_rec = d.c_mesa_rec
                    INNER JOIN (select c_mesa_rec, n_ambito, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '105') x6 ON x6.n_ambito = d.n_ambito AND x6.c_mesa_rec = d.c_mesa_rec  
                  WHERE d.c_mesa_rec = '".$mesa."'
                  GROUP BY d.c_mesa_rec, d.n_ambito, x1.aud_cred_reg_fec, x2.aud_cred_reg_fec, x3.aud_cred_reg_fec, x4.aud_cred_reg_fec, x5.aud_cred_reg_fec, x6.aud_cred_reg_fec
                  ORDER BY 1";
        
        $result = DB::select(DB::raw($query));
        return $result;
   }
   
   public function searchFiltro($filtro, $local, $valueRange,$ambito){

    	$query = "SELECT d.c_mesa_rec, d.n_ambito, d.c_local
                    , x1.aud_cred_reg_fec AS PRESIDENTE, x2.aud_cred_reg_fec AS SECRETARIO, x3.aud_cred_reg_fec AS TERCER_MIEMBRO, x4.aud_cred_reg_fec AS PRIMER_SUPLENTE, x5.aud_cred_reg_fec AS SEGUNDO_SUPLENTE, x6.aud_cred_reg_fec AS TERCER_SUPLENTE  
                    , (CASE WHEN x1.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x2.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x3.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x4.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x5.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x6.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END) AS ESTADO
                  FROM tab_padron_designacion d
                    INNER JOIN (select c_mesa_rec, n_ambito, c_local, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '100') x1 ON x1.n_ambito = d.n_ambito AND x1.c_mesa_rec = d.c_mesa_rec AND x1.c_local = d.c_local
                    INNER JOIN (select c_mesa_rec, n_ambito, c_local, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '101') x2 ON x2.n_ambito = d.n_ambito AND x2.c_mesa_rec = d.c_mesa_rec AND x1.c_local = d.c_local
                    INNER JOIN (select c_mesa_rec, n_ambito, c_local, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '102') x3 ON x3.n_ambito = d.n_ambito AND x3.c_mesa_rec = d.c_mesa_rec AND x1.c_local = d.c_local
                    INNER JOIN (select c_mesa_rec, n_ambito, c_local, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '103') x4 ON x4.n_ambito = d.n_ambito AND x4.c_mesa_rec = d.c_mesa_rec AND x1.c_local = d.c_local
                    INNER JOIN (select c_mesa_rec, n_ambito, c_local, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '104') x5 ON x5.n_ambito = d.n_ambito AND x5.c_mesa_rec = d.c_mesa_rec AND x1.c_local = d.c_local
                    INNER JOIN (select c_mesa_rec, n_ambito, c_local, aud_cred_reg_fec from tab_padron_designacion where n_param_cargo_pk = '105') x6 ON x6.n_ambito = d.n_ambito AND x6.c_mesa_rec = d.c_mesa_rec AND x1.c_local = d.c_local 
                  WHERE (CASE WHEN x1.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x2.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x3.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x4.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x5.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END
                        + CASE WHEN x6.aud_cred_reg_fec IS NULL THEN 0 ELSE 1 END) 
                        BETWEEN '".$valueRange."' AND '".$filtro."'";

                        if($local!==''){
                          $query.=" AND d.c_local = '".$local."'";
                        }
                        if($ambito!=null){
                          $query.=" AND d.n_ambito = '".$ambito."'";
                        }
                        
                        
                  
                $query.=" GROUP BY d.c_mesa_rec, d.n_ambito, d.c_local, x1.aud_cred_reg_fec, x2.aud_cred_reg_fec, x3.aud_cred_reg_fec, x4.aud_cred_reg_fec, x5.aud_cred_reg_fec, x6.aud_cred_reg_fec
                  ORDER BY 1";
        $result = DB::select(DB::raw($query));
        return $result;
   }
   

}
