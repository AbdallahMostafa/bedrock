<?php
function custom_applied_activate() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'applied_users';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id bigint(9) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        job_id bigint(9),
        PRIMARY KEY (id)
    ) $charset_collate;";
    
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    
    dbDelta($sql);
}

register_activation_hook(__FILE__, 'custom_applied_activate');
