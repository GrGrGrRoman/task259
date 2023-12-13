<?php

namespace App\core;

use App\config\Db;

abstract class Model 
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }
}