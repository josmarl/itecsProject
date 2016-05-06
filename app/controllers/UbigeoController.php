<?php

class  UbigeoController extends BaseController {

    public function fetch($ambito=null) {
    	$ubigeo = new Ubigeo();
    	return $ubigeo->fetch($ambito);
    }
    public function obtenerDistritos($ambito) {
        $ubigeo = new Ubigeo();
        $response = $ubigeo->fetch($ambito);
        $this->response = new StdClass();
        $this->response->success = true;
        $this->response->message = '';
        $this->response->data = $response;
        return json_encode($this->response);
    }
}
