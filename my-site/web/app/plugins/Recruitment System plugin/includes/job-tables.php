<?php
function custom_jobs_activate() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'jobs';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id bigint(9) NOT NULL AUTO_INCREMENT,
        title TEXT(100) NOT NULL,
        description,
        department TEXT(50),
        start_date date,
        end_date date,
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    // require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'custom_jobs_activate');
