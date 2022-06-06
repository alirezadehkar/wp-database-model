<?php
 namespace ADHK\WP;

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

use ADHK\WP\Database_Generator;

abstract class Database_Model extends Database_Generator
{
    protected static $table;

    /**
     * Generate where sql query
     *
     * @param array $params
     * @return void
     */
    private static function preSql($params = []){
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

    public static function getResults($params = [])
    {
        global $wpdb;
        $table = static::$table;
        $pre_sql = static::preSql($params);
        $sql = "SELECT * FROM `{$table}` $pre_sql";
        $stmt = $wpdb->get_results($wpdb->prepare($sql), $params['output']);
        return $stmt;
    }

    public static function get($fields = [])
    {
        global $wpdb;
        $table = static::$table;
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
        $stmt = $wpdb->get_row($wpdb->prepare($sql));
        return $stmt;
    }

    public static function insert($data)
    {
        global $wpdb;
        $table = static::$table;
        $insert = $wpdb->insert($table, $data);
        return ($insert) ? $wpdb->insert_id : false;
    }

    public static function delete($where)
    {
        global $wpdb;
        $table = static::$table;
        $delete = $wpdb->delete($table, $where);
        return $delete;
    }

    public static function update($data, $where)
    {
        global $wpdb;
        $table = static::$table;
        $update = $wpdb->update($table, $data, $where);
        return $update;
    }

    public static function count($params = [])
    {
        global $wpdb;
        $table = static::$table;
        $pre_sql = static::preSql($params);
        $sql = "SELECT COUNT(*) FROM `{$table}` {$pre_sql}";
        $stmt = $wpdb->get_var($wpdb->prepare($sql));
        return $stmt;
    }

    public static function countBy($fields = [])
    {
        global $wpdb;
        $table = static::$table;
        $params = ['fields' => []];
        if($fields){
            foreach($fields as $key => $value){
                $params['fields'][] = [
                    'key' => $key,
                    'value' => $value,
                ];
            }
        }
        $pre_sql = static::preSql($params);
        $sql = "SELECT COUNT(*) FROM `{$table}` {$pre_sql}";
        $stmt = $wpdb->get_var($wpdb->prepare($sql));
        return $stmt;
    }

    public static function getError()
    {
        global $wpdb;
        return $wpdb->last_error;
    }
}
