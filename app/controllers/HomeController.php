<?php

class HomeController extends BaseController {

    protected $layout = 'layout.master';

    public function dashboarIndex() {
        return View::make('proyecto/index');
    }

    public function showWelcome() {
        return View::make('hola');
    }

    public function missingMethod($parameters = array()) {
        return Redirect::to("/");
    }

}
