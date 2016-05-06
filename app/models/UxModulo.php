<?php

class UxModulo extends BaseModel {

    protected $table = 'TAB_UX_MODULO';
    protected $primaryKey = 'n_ux_modulo_pk';

    public $timestamps = false;
    
    public function getModulos($param) {
        $query = "SELECT a.n_ux_modulo_pk, m.c_descripcion, m.c_url "
                . "FROM tab_acl a LEFT JOIN tab_ux_modulo m on m.n_ux_modulo_pk = a.n_ux_modulo_pk "
                . "where a.n_perfil_pk = '".$param."' "
                . "group by a.n_ux_modulo_pk, m.c_descripcion, m.c_url order by 1";
        
        $result = DB::select(DB::raw($query));
        return $result;
    }
    
    
}
