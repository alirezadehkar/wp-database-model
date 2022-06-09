<?php
namespace AlirezaDehkar\WPDBModel;
abstract class Database_Model
{
    private $wpdb;
    private $prefix;
    protected static $table;

    /**
     * 
     * Database_Model __construct
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

    /**
     * Generate where sql query
     *
     * @param array $params
     * @return void
     */
    private function preSql($params = []){
        $where = '';
        $value = '';
        $fields = (isset($params['fields']) && is_array($params['fields']) && count($params['fields']) > 0) ? $params['fields'] : [];
        if ($fields) {
            $i = 0;
            foreach ($fields as $field) {
                if (!empty($field) && is_array($field) && count($field) > 0) {
                    $i++;
                    if($i <= 1){
                        $where .= 'WHERE ';
                    }
                    if ($i > 1) {
                        $where .= ' AND ';
                    }
                    if(!isset($field['compare']) || (isset($field['compare']) && empty($field['compare']))){
                        $field['compare'] = '=';
                    }
                    $value = "'{$field['value']}'";
                    if(intval($field['value'])){
                        $value = $field['value'];
                    }
                    $where .= " `{$field['key']}` {$field['compare']} {$value}";
                }
            }
        }

        if (!array_key_exists('output', $params)) {
            $params['output'] = OBJECT;
        }

        if(isset($params['per_page']) && isset($params['offset'])){
            $limit = " LIMIT {$params['offset']}, {$params['per_page']}";
        } elseif(isset($params['per_page'])) {
            $limit = " LIMIT {$params['per_page']}";
        }
        $order = (array_key_exists('order', $params)) ? $params['order'] : 'DESC';
        $order_by = (array_key_exists('order_by', $params)) ? " ORDER BY `{$params['order_by']}` {$order}" : '';

        return "{$where} {$order_by} {$limit}";
    }

    /**
     * Get database results
     *
     * @param array $params
     * @return void
     */
    public function getResults($params = [])
    {
        $table = $this->prefix . $this->table;
        $pre_sql = $this->preSql($params);
        $sql = "SELECT * FROM `{$table}` $pre_sql";
        $stmt = $this->wpdb->get_results($this->wpdb->prepare($sql), $params['output']);
        return $stmt;
    }

    /**
     * Get a row
     *
     * @param array $fields
     * @return void
     */
    public function get($fields = [])
    {
        $table = $this->prefix . static::$table;
        $where = '';

        if (is_array($fields) && count($fields) > 0) {
            $where .= 'WHERE ';
            $i = 0;
            foreach ($fields as $key => $value) {
                $i++;
                if ($i > 1) {
                    $where .= ' AND ';
                }
                $where .= " `{$key}` = '$value' ";
            }
        }

        $sql = "SELECT * FROM `{$table}` {$where}";
        $stmt = $this->wpdb->get_row($this->wpdb->prepare($sql));
        return $stmt;
    }

    /**
     * Insert data
     *
     * @param array $data
     * @return void
     */
    public function insert($data)
    {
        $table = $this->prefix . $this->table;
        $insert = $this->wpdb->insert($table, $data);
        return ($insert) ? $this->wpdb->insert_id : false;
    }

    /**
     * Delete data
     *
     * @param array $where
     * @return void
     */
    public function delete($where)
    {
        $table = $this->prefix . static::$table;
        $delete = $this->wpdb->delete($table, $where);
        return $delete;
    }

    /**
     * Update data
     *
     * @param array $data
     * @param array $where
     * @return void
     */
    public function update($data, $where)
    {
        $table = $this->prefix . static::$table;
        $update = $this->wpdb->update($table, $data, $where);
        return $update;
    }

    /**
     * Get data count
     *
     * @param array $params
     * @return void
     */
    public function count($params = [])
    {
        $table = $this->prefix . static::$table;
        $pre_sql = $this->preSql($params);
        $sql = "SELECT COUNT(*) FROM `{$table}` {$pre_sql}";
        $stmt = $this->wpdb->get_var($this->wpdb->prepare($sql));
        return $stmt;
    }

    /**
     * Get data count by fields
     *
     * @param array $fields
     * @return void
     */
    public function countBy($fields = [])
    {
        $table = $this->prefix . static::$table;
        $params = ['fields' => []];
        if($fields){
            foreach($fields as $key => $value){
                $params['fields'][] = [
                    'key' => $key,
                    'value' => $value,
                ];
            }
        }
        $pre_sql = $this->preSql($params);
        $sql = "SELECT COUNT(*) FROM `{$table}` {$pre_sql}";
        $stmt = $this->wpdb->get_var($this->wpdb->prepare($sql));
        return $stmt;
    }

    /**
     * Get database last error
     *
     * @return void
     */
    public function getError()
    {
        return $this->wpdb->last_error;
    }
}
