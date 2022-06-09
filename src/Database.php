<?php
namespace AlirezaDehkar\WPDBModel;

class Database extends Database_Model
{
    private static $instance = null;

    public static function getInstance(){
        if(static::$instance == null){
            static::$instance = new self();
        }

        return static::$instance;
    }
}