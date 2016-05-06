<?php

class Backlog extends BaseModel {

    protected $table = 'backlog';
    protected $primaryKey = 'id';
    public $timestamps = false;

    function __construct() {
        
    }

    public function getBacklogByProyecto($proyecto) {
        $query = 'select b.id as idBacklog,b.nombre as nombreBacklog,p.nombre as nombreProyecto, c.valor
                  from backlog b
                  inner join proyecto p on b.id_proyecto=p.id
                  inner join complejidad c on b.id_complejidad=c.id
                  where p.id=' . $proyecto;
        $result = DB::select(DB::raw($query));
        return $result;
    }

    public function getProyectoById($idProyecto) {
        $query = 'select p.nombre from proyecto p where p.id=' . $idProyecto;
        $result = DB::select(DB::raw($query));
        return $result;
    }

    public function fetchPersonaByProyecto($idProyecto) {
        $query = "select CONCAT(p.nombres,' ',p.paterno,' ',p.materno) as nombres, r.nombre as rol 
                    from proyecto_persona pp
                    inner join persona p
                    on pp.id_persona = p.id
                    inner join rol r
                    on pp.id_rol = r.id
                    where pp.id_proyecto = " . $idProyecto;
        $result = DB::select(DB::raw($query));
        return $result;
    }

    public function fetchComplejidad() {
        $query = 'select * from complejidad';
        $result = DB::select(DB::raw($query));
        return $result;
    }

    public function saveBacklog($data) {

        $backlog = new Backlog();
        $backlog->nombre = $data->nombre;
        $backlog->id_complejidad = $data->idComplejidad;
        $backlog->prioridad = $data->prioridad;
        $backlog->id_proyecto = $data->idProyecto;
        $backlog->save();
    }
    
    public function removeBacklog($id) {
        Backlog::where('id', '=', $id)->delete();
    }

}
