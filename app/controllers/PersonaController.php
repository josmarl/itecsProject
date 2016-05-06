<?php

class PersonaController extends BaseController {

    function __construct() {
        
    }

    public function viewPersona() {
        return View::make('persona/index');
    }

    public function fetchPersona() {
        $personaDao = new Persona();
        return $personaDao->fetchPersona();
    }

}
