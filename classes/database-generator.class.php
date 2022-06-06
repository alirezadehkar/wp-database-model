<?php
 namespace ADHK\WP;

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

class Database_Generator
{
    protected $wpdb;
    protected $prefix;
    protected $table;
    protected $rows = [];

    /**
     * Database __construct
     */
    public function __construct(){
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->prefix = $wpdb->prefix;
    }

    /**
     *
     * Set table name
     *
     * @param $name
     * @return $this
     */
    public function setTableName($name)
    {
        $this->table = $name;

        return clone $this;
    }

    /**
     *
     * Set table rows
     *
     * @param array $rows
     * @return $this
     */
    public function setRows(array $rows = array())
    {
        $this->rows[] = $rows;

        return clone $this;
    }

    /**
     * Create new table
     */
    public function createTable()
    {
        $table_name = $this->prefix . $this->table;
        $charset_collate = $this->wpdb->get_charset_collate();
        $fields = implode(', ', $this->rows[0]);
        $sql = "CREATE TABLE IF NOT EXISTS {$table_name} ({$fields}) ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);
    }

    public function query($query)
    {
        $stmt = $this->wpdb->query($query);
        return $stmt;
    }
}
