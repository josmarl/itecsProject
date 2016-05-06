<?php

class BaseController extends Controller {

    private $response;

    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public function strtodouble($str) {
        $str = str_replace(',', '.', $str);
        return (float) $str;
    }

    public function setResponse($success, $messages, $errors, $exception, $data) {
        $this->response = new stdClass();
        $this->response->success = $success;
        //$this->response->messages = $messages;
        $this->response->messages = $messages . ' ' . Carbon::now()->toTimeString();
        $this->response->errors = $errors;
        $this->response->exception = $exception;
        $this->response->data = $data;

        return $this->response;
    }

    public function getClassResponse() {
        $error = new stdClass();
        $error->success = true;
        $error->message = '';
        $error->code = '';
        $error->data = null;
        return $error;
    }

    public function getConstants() {
        return (object) Config::get('constants');
    }

    public function getMessages() {
        return (object) Lang::get('message');
    }

    protected function getDateFormat() {
        return (object) Config::get('dateformat');
    }

    public function getUbigeoByUser() {
        $usu = new User();
        $usu = $usu->buscarUsuario(Session::get('usuario.username'));
        $data = UsuarioOdpe::listarUbigeoUser($usu->usuario);
        $deps = array();
        foreach ($data as $ubi) {
            $deps[] = $ubi->ubigeo;
        }
        if (count($deps) == 0) {
            $deps = array('0');
        }
        return $deps;
    }

    public function generacionPaginacion($nreg, $const) {
        $cantidad = ceil($nreg / (int) $const);
        $listcant = array();
        for ($i = 0; $i < $cantidad; $i++) {
            $obj = new stdClass();
            $obj->num = $i;
            array_push($listcant, $obj);
        }

        return $listcant;
    }

    public function retornarRutaArchivos() {
        return $_SERVER['DOCUMENT_ROOT'] . "/evaSirec/uploads/";
    }

}
