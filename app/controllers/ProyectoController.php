<?php

class ProyectoController extends BaseController {

    public function viewProyecto() {
        return View::make('proyecto/index');
    }

    public function fetchProyecto() {
        $proyectosDao = new Proyecto();
        return $proyectosDao->fetchProyecto();
    }

    public function saveProyecto() {

        $this->response = new StdClass();
        $this->response->success = false;
        $this->response->message = Messages::ERROR;
        $data = (object) Input::all();

        try {
            $proyectosDao = new Proyecto();
            $proyectosDao->saveProyecto($data);
            $this->response->success = true;
            $this->response->message = Messages::SUCCESS_SAVE;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return json_encode($this->response);
    }

    public function removeProyecto() {
        $this->response = new StdClass();
        $this->response->success = false;
        $this->response->message = Messages::ERROR;
        $id = Input::get('id');

        try {
            $proyectosDao = new Proyecto();
            $proyectosDao->removeProyecto($id);
            $this->response->success = true;
            $this->response->message = Messages::SUCCESS_REMOVE;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        return json_encode($this->response);
    }

}
