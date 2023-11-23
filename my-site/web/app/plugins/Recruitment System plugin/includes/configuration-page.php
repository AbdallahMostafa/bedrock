<?php

add_action('admin_menu', 'custom_job_titles_add_submenu_page');
// add_action('admin_menu', 'custom_job_titles_config_page_content');


function custom_job_titles_add_submenu_page() {
    // Your menu registration code here
    add_submenu_page(
        'recruitment_system_plugin',
        'Configuration',
        'Configuration',
        'manage_options',
        'configuration',
        'custom_job_titles_config_page_content'
    );
}

function custom_job_titles_config_page_content() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submissions for updating configuration
        // Validate and sanitize inputs, update the configuration
        $count_to_show = intval($_POST['count_to_show']);
        // Save the configuration to the database or any other storage
        update_option('custom_job_titles_count_to_show', $count_to_show);
        
        // Display a success message
        echo '<div class="notice notice-success">Configuration updated successfully.</div>';
    }
    
    // Display the configuration form
    $count_to_show = get_option('custom_job_titles_count_to_show');
    
    ?>
    <div class="wrap">
    <h2>Custom Job Vacancy Configuration</h2>
        <form method="post" action="">
            <label for="count_to_show">Count of Job Titles to Show:</label>
            <input type="number" name="count_to_show" id="count_to_show" value="<?= $count_to_show ?>" min="1" required>

            <input type="submit" class="button-primary" value="Save Changes">

        </form>
    </div>
<?php
}
