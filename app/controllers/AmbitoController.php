<?php

class AmbitoController extends BaseController {

    public function fetch() {
        $ambitoDao = new Ambito();
        return $ambitoDao->fetch();
    }

    public function fetchAmbitoDesign() {
        $padronDao = new PadronDesignacion();
        return $padronDao->fetchAmbitoDesign();
    }

}
