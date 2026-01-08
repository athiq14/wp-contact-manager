<?php
/**
 * Plugin Name: WP Contact Manager
 * Plugin URI: https://github.com/athiq14/wp-contact-manager
 * Description: A simple plugin to store and manage contact form submissions.
 * Version: 1.0.0
 * Author: Mohamed Athiq
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

define('WPCM_PATH', plugin_dir_path(__FILE__));

require_once WPCM_PATH . 'includes/admin-page.php';

register_activation_hook(__FILE__, 'wpcm_create_table');

function wpcm_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_manager';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        message text NOT NULL,
        created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
