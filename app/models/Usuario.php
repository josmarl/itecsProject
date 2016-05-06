<?php

class Usuario extends BaseModel {

    protected $table = 'usuario';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function __construct() {
        
    }

    public function validar($param) {
        $data = DB::table('usuario')
                ->select(array('username', 'password'))
                ->where('username', $param['username'])
                ->where('password', $param['password'])
                ->first();
        return $data;
    }

}
