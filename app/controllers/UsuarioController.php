<?php

class UsuarioController extends BaseController {

    protected $layout = 'layout.master';
    private $response;

    public function index() {
        return View::make('login.index', array());
    }

    public function login() {
        $usuarioDao = new Usuario();
        $data = (Object) Input::all();
        if (!Session::has('usuario.id')) {
            if (!empty($data->username)) {
                if (!empty($data->password)) {
                    $validation_input = $usuarioDao->validar(Input::all());
                    if ($validation_input) {
                        Session::put('usuario.username', $validation_input);
                        return Redirect::to("/");
                    } else {
                        Session::flush();
                        Session::flash('autentificacion.novalida', Messages::LOGIN_FAIL);
                        return Redirect::to("/");
                    }
                } else {
                    Session::flush();
                    Session::flash('autentificacion.novalida', Messages::LOGIN_PASSWORD);
                    return Redirect::to("/");
                }
            } else {
                Session::flush();
                Session::flash('autentificacion.novalida', Messages::LOGIN_USER);
                return Redirect::to("/");
            }
        } else {
            $menu = new stdClass;
            $menu->c_descripcion = '';
            $menu->c_url = '';
            $array[] = $menu;
            Session::put('menu', $array);
            return View::make('dashboard/index');
        }
    }

    public function getProcesosElectorales() {
        $proceso = new Proceso();
        $response = $proceso->getProcesosElectorales(Session::get('usuario.userid'));
        return $response;
    }

    public function searchEsquema($param) {
        $this->response = new StdClass();
        $this->response->success = false;
        $this->response->message = Messages::ERROR;
        if (!Config::set('database.default', $param)) {
            $this->response->success = true;
            $this->response->message = '';
            $this->response->data = $param;
        } else {
            $this->response->success = false;
            $this->response->message = Messages::ERROR;
            $this->response->data = $param;
        }

        return json_encode($this->response);
    }

    public function getModulos() {
        $uxmodulo = new UxModulo();
        $response = $uxmodulo->getModulos(Session::get('usuario.perfilid'));
        return $response;
    }

    public function salir() {
        Session::flush();
        return Redirect::to("/");
    }

}
