<?php
/*
    Plugin Name: Recruitment System
    Description: A custom plugin for managing job vacancy.
    Version: 1.0
    Author: Abdallah Mostafa
*/

// Activation and deactivation hooks
include_once plugin_dir_path(__FILE__) . 'includes/activation.php';

// Configuration page
include_once plugin_dir_path(__FILE__) . 'includes/admin-pages.php';

include_once plugin_dir_path(__FILE__) . 'includes/configuration-page.php';

include_once plugin_dir_path(__FILE__) . 'includes/add-job-pages.php';
