<?php
namespace AlirezaDehkar\WPDBModel;

class Database extends Database_Model
{
    /**
     * 
     * Database __construct
     * 
     */
    public function __construct($table = '')
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->prefix = $this->wpdb->prefix;
        if(!empty($table)){
            static::$table = $table;
        }
    }
}