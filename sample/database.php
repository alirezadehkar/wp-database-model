<?php
namespace ADHK\WP;

/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

use ADHK\WP\Database_Model;

class Database extends Database_Model {
    protected static $table = 'requests';
}