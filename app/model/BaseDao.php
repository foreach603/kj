<?php

namespace model;

// require "../../vendor/autoload.php";

use Medoo\Medoo;

class BaseDao extends Medoo
{
    function __construct()
    {
        $options = [
            'database_type' => 'mysql',
            'database_name' => 'kj',
            'server' => 'localhost',
            'username' => 'root',
            'password' => 'root',
            'prefix' => 'kj_'
        ];
        parent::__construct($options);
    }
}
