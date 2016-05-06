<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Archivo extends BaseModel implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    protected $table = 'TAB_ARCHIVO';
    protected $primaryKey = 'N_ARCHIVO_PK';

    public $timestamps = false;

    public function __construct() {
        $this->response = $this->getClassResponse();
    }   

}
