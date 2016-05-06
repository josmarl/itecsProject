<?php

class Local extends BaseModel {

    protected $table = 'TAB_LOCAL';
    protected $primaryKey = 'c_local_pk';

    public $timestamps = false;

    public function fetch($ubigeo) {

        $query = "SELECT l.c_local_pk, l.c_nombre "
                . "FROM tab_local l "
                . "JOIN tab_mesa m ON l.c_local_pk = m.c_local "
                . "WHERE m.c_ubigeo_pk = '".$ubigeo."' GROUP BY l.c_local_pk, l.c_nombre";
        
        $result = DB::select(DB::raw($query));
        return $result;
    }

}
