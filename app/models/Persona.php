<?php

class Persona {

    protected $table = 'persona';
    protected $primaryKey = 'id';
    public $timestamps = false;

    function __construct() {
        
    }

    public function fetchPersona() {
        $query = "select p.id,p.nombres,p.paterno,p.materno,pr.nombre from persona p
                  inner join proyecto_persona pp on p.id=pp.id_persona
                  inner join proyecto pr on pr.id=pp.id_proyecto";
        $result = DB::select(DB::raw($query));
        return $result;
    }

}
