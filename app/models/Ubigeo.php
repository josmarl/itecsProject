<?php

class Ubigeo extends BaseModel{


    protected $table = 'TAB_UBIGEO';
    protected $primaryKey = 'n_ubigeo_pk';
    public $timestamps = false;

    public function __construct() {
        
    }

    public function fetch($ambito){
    	if($ambito!==null){
    		$ubigeos= Ubigeo::select(array('c_ubigeo_pk','c_distrito'))->where('n_ambito',$ambito)->orderby('c_distrito')->get();
    	}else{
    		$ubigeos= Ubigeo::select(array('c_ubigeo_pk','c_distrito'))->orderby('c_distrito')->get();
    	}
    	return $ubigeos;
    }
}
