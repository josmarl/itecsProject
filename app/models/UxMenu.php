<?php

class UxMenu extends BaseModel {

    protected $table = 'TAB_UX_MENU';
    protected $primaryKey = 'n_ux_menu_pk';

    public $timestamps = false;
    
    public function getMenu($mod,$perfil) {        
        $query =  " select u.c_descripcion, u.c_url 
                    from tab_ux_menu u 
                    inner join tab_acl a on u.n_ux_menu_pk = a.n_ux_menu_pk
                    where a.n_ux_modulo_pk = '".$mod."'
                    and a.n_perfil_pk='".$perfil."' order by u.n_ux_menu_pk ";        
        $result = DB::select(DB::raw($query));
        return $result;
    }
}
