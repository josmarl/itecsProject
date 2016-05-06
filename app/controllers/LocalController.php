<?php

class  LocalController extends BaseController {

    public function obtenerLocales($ubigeo) {
        $local = new Local();
        $response = $local->fetch($ubigeo);
        $this->response = new StdClass();
        $this->response->success = true;
        $this->response->message = '';
        $this->response->data = $response;
        return json_encode($this->response);
    }

}
