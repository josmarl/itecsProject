<?php

class BacklogController extends BaseController {

    function __construct() {
        
    }

    public function viewBacklog($proyecto) {
        $backlogDao = new Backlog();
        $nombreProyecto = $backlogDao->getProyectoById($proyecto)[0]->nombre;
        $sizeBacklog = sizeof($backlogDao->getBacklogByProyecto($proyecto));
        return View::make('proyecto/backlog-add')
                        ->with('proyecto', $proyecto)
                        ->with('nombreProy', $nombreProyecto)
                        ->with('sizeBacklog', $sizeBacklog);
    }

    public function getBacklogByProyecto($proyecto) {

        $backlogDao = new Backlog();
        $this->response = new StdClass();
        $this->response->success = false;
        $this->response->message = Messages::ERROR;
        $this->response->optional = 0;

        try {
            $this->response->result = $backlogDao->getBacklogByProyecto($proyecto);
            $this->response->success = true;
            $this->response->message = Messages::SUCCESS_LIST;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return json_encode($this->response);
    }

    public function fetchPersonaByProyecto($proyecto) {
        $backlogDao = new Backlog();
        $this->response = new stdClass();
        $this->response->result = null;
        $this->response->success = false;
        $this->response->message = Messages::ERROR;

        try {
            $this->response->result = $backlogDao->fetchPersonaByProyecto($proyecto);
            $this->response->success = true;
            $this->response->message = Messages::SUCCESS_LIST;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return json_encode($this->response);
    }

    public function fetchComplejidad() {
        $backlogDao = new Backlog();
        $this->response = new stdClass();
        $this->response->result = null;
        $this->response->success = false;
        $this->response->message = Messages::ERROR;

        try {
            $this->response->result = $backlogDao->fetchComplejidad();
            $this->response->success = true;
            $this->response->message = Messages::SUCCESS_LIST;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return json_encode($this->response);
    }

    public function saveBacklog() {

        $this->response = new stdClass();
        $this->response->success = false;
        $this->response->message = Messages::ERROR;
        $data = (object) Input::all();

        try {
            $backlogDao = new Backlog();
            $backlogDao->saveBacklog($data);
            $this->response->success = true;
            $this->response->message = Messages::SUCCESS_SAVE;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return json_encode($this->response);
    }

    public function removeBacklog() {

        $this->response = new stdClass();
        $this->response->success = false;
        $this->response->message = Messages::ERROR;
        $id = Input::all('idBacklog');

        try {
            $backlogDao = new Backlog();
            $backlogDao->removeBacklog($id);
            $this->response->success = true;
            $this->response->message = Messages::SUCCESS_REMOVE;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return json_encode($this->response);
    }

}
