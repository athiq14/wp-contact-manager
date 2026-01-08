<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_menu', 'wpcm_register_admin_page');

function wpcm_register_admin_page() {
    add_menu_page(
        'Contact Manager',
        'Contact Manager',
        'manage_options',
        'wpcm-contact-manager',
        'wpcm_admin_page_html',
        'dashicons-email',
        20
    );
}

function wpcm_admin_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_manager';
    $results = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<div class="wrap">';
    echo '<h1>Contact Submissions</h1>';
    echo '<table class="widefat fixed striped">';
    echo '<tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>';

    foreach ($results as $row) {
        echo '<tr>';
        echo '<td>' . esc_html($row->name) . '</td>';
        echo '<td>' . esc_html($row->email) . '</td>';
        echo '<td>' . esc_html($row->message) . '</td>';
        echo '<td>' . esc_html($row->created_at) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
}
