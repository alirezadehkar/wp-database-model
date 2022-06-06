<?php
/**
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}

use ADHK\WP\Database as DB;

$requests = DB::getResults();