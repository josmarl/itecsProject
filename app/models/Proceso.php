<?php

class Proceso extends BaseModel{

    protected $table = 'TAB_PROCESO';
    protected $primaryKey = 'N_PROCESO_PK';

    public $timestamps = false;

    public function getProcesosElectorales($param) {
        $query = "SELECT P.N_PROCESO_PK, P.C_NOMBRE_PROCESO, P.C_ALIAS, P.C_NOMBRE_CONEXION "
                . "FROM TAB_PROCESO P LEFT JOIN TAB_USUARIO_PROCESO U  "
                . "ON P.N_PROCESO_PK = U.N_PROCESO "
                . "WHERE U.N_USUARIO= '".$param."'";
        $result = DB::select(DB::raw($query));
        return $result;
    }

}
