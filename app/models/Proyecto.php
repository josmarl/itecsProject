<?php

class Proyecto extends BaseModel {

    protected $table = 'proyecto';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function __construct() {
        
    }

    public function fetchProyecto() {
        $query = "select * from proyecto";
        $result = DB::select(DB::raw($query));
        return $result;
    }

    public function saveProyecto($data) {
        $proyecto = new Proyecto();
        $proyecto->nombre = $data->nombre;
        $proyecto->save();
    }

    public function removeProyecto($id) {
        Proyecto::where('id', '=', $id)->delete();
    }

}
