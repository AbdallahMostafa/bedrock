<?php
// Job titles page functions
add_action('admin_menu', 'custom_job_titles_menu');

include_once plugin_dir_path(__FILE__) . 'delete-job.php';

function custom_job_titles_menu() {
    // Your menu registration code here
    add_menu_page(
        'Jobs Plugin',
        'Jobs Plugin',
        'manage_options',
        'recruitment_system_plugin',
        'custom_job_titles_page'
    );
    
}
// Job titles page function
function custom_job_titles_page() {
    
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['job_id'])) {
        $job_id = (int) $_GET['job_id'];
        deleteJob($job_id);
    }

    // Retrieve the count of job titles to show from the configuration
    $count_to_show = get_option('custom_job_titles_count_to_show', 10);

    // Query the database to get job titles based on the count
    global $wpdb;
    $table_name = $wpdb->prefix . 'jobs';
    $jobs = $wpdb->get_results("SELECT * FROM $table_name WHERE end_date >= CURRENT_DATE ORDER BY end_date LIMIT $count_to_show");

    // Display the job titles in your listing page
?>
    <div class="wrap">
        <h2>Job Titles</h2>
        <ul>
            <?php foreach ($jobs as $job) : ?>
                <li>
                    <a href="<?php echo admin_url('admin.php?page=custom-job-vacancies&job_id=' . $job->id); ?>"><?php echo $job->title; ?></a>
                    <a href="<?php echo admin_url('admin.php?page=recruitment_system_plugin&action=delete&job_id=' . $job->id); ?>" class="delete-job-button">Delete</a>
                    <a href="<?php echo admin_url('admin.php?page=apply-jobs-page&job_id=' . $job->id); ?>">Apply</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php


}
