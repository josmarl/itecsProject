<?php

class Ambito extends BaseModel {

    protected $table = 'TAB_AMBITO';
    protected $primaryKey = 'n_ambito_pk';
    public $timestamps = false;

    public function __construct() {
        
    }
    
    public function fetchPadronDesig(){
    	$query = "SELECT d.n_ambito, a.c_alias "
                . "FROM tab_padron_designacion d JOIN tab_ambito a ON a.n_ambito_pk = d.n_ambito GROUP BY d.n_ambito, a.c_alias";
        
        $result = DB::select(DB::raw($query));
        return $result;
    }
    
    public function searchOdpe($n_ambito){
    	$query = "SELECT n_ambito_pk n_ambito, c_alias FROM tab_ambito WHERE n_ambito_pk = '".$n_ambito."'";
        
        $result = DB::select(DB::raw($query));
        return $result;
    }

    public function fetch() {
        return Ambito::select(array('n_ambito_pk', 'c_codigo', 'c_alias'))->whereNotNull('n_ambito_padre_pk')->orderby('c_alias')->get();
    }

    public function findById($param) {
        return Ambito::select(array('n_ambito_pk', 'c_codigo', 'c_alias'))->where('n_ambito_pk', $param)->first();
    }

}
