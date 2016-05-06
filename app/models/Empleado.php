<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Empleado extends BaseModel implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    protected $table = 'TAB_EMPLEADO';
    protected $primaryKey = 'N_EMPLEADO_PK';

    public $timestamps = false;

    public function __construct() {
        $this->response = $this->getClassResponse();
    }   

}
