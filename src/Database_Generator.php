<?php
 namespace AlirezaDehkar\WPDBModel;

class Database_Generator
{
    protected $_prefix;
    protected $table;
    protected $rows = [];

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
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table;
        $charset_collate = $wpdb->get_charset_collate();
        $fields = implode(', ', $this->rows[0]);
        $sql = "CREATE TABLE IF NOT EXISTS {$table_name} ({$fields}) ENGINE = InnoDB $charset_collate;";
        dbDelta($sql);
    }

    /**
     * Drop table
     */
    public function drop()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table;
        return $this->query("DROP TABLE {$table_name}");
    }

    /**
     * @param string $query
     * @return void
     */
    public function query($query)
    {
        global $wpdb;
        $stmt = $wpdb->query($query);
        return $stmt;
    }
}
