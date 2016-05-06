<?php

class ModulosController extends BaseController {

    protected $layout = 'modulos.index';
    private $response;

    public function index($mod) {
        $uxmenu = new UxMenu();
        if (!Session::has('usuario.username')) {
            return Redirect::to('/');
        } else {
            $perfil= Session::get('usuario.perfilid');
            $response = $uxmenu->getMenu($mod,$perfil);
            Session::put('menu', $response);
            return View::make('modulos.index', array("menu" => $response,'isDropDowList'=>($mod==Constants::MODULE_REP)));
        }                
    }

    


}
