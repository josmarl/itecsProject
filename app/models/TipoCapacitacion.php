<?php

class TipoCapacitacion extends BaseModel{

    protected $table = 'TAB_TIPO_CAPACITACION';
    protected $primaryKey = 'N_TIPO_CAPACITACION_PK';
    public $timestamps = false;

    public function __construct() {
        
    }

    public function listaTipoCapac() {
        $query = "SELECT * FROM TAB_TIPO_CAPACITACION";
        $result = DB::select(DB::raw($query));
        return $result;
    }

}
