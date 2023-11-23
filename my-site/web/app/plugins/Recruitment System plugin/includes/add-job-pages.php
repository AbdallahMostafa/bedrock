<?php 

add_action('admin_menu', 'custom_job_vacancies_submenu');


function custom_job_vacancies_submenu() {
    add_submenu_page(
        'recruitment_system_plugin',
        'Add Jobs',
        'Add Jobs',
        'manage_options',
        'custom-job-vacancies',
        'custom_job_vacancies_page'
    );
}


function custom_job_vacancies_page() {

    $job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;
    
    $title = '';
    $description = '';
    $department = '';
    $start_date = '';
    $end_date = '';
    // Retrieve job data if editing an existing job
    if ($job_id) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'jobs';
        $job_data = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $job_id");

        // Populate form fields with job data
        $title = $job_data->title;
        $description = $job_data->description;
        $department = $job_data->department;
        $start_date = $job_data->start_date;
        $end_date = $job_data->end_date;
    } 



    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submissions for adding/editing job vacancy.
        // Validate and sanitize inputs, save to the database

        // Validate and sanitize inputs
        $title = sanitize_text_field($_POST['title']);
        $description = sanitize_textarea_field($_POST['description']);
        $department = sanitize_text_field($_POST['department']);
        $start_date = sanitize_text_field($_POST['start_date']);
        $end_date = sanitize_text_field($_POST['end_date']);

        // Save data to the database
        global $wpdb;
        $table_name = $wpdb->prefix . 'jobs';

        $wpdb->insert(
            $table_name,
            array(
                'title' => $title,
                'description' => $description,
                'department' => $department,
                'start_date' => $start_date,
                'end_date' => $end_date,
            )
        );
        // Display a success message
        echo '<div class="notice notice-success">Job Added Successfully.</div>';

    }

    ?>
<div class="wrap">
    <h2>Add/Edit Job Vacancy</h2>
    <form method="post" action="">
        <label for="title">Job Title:</label>
        <input type="text" name="title" id="title" value="<?= $title ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" maxlength="500"><?= $description ?></textarea>

        <label for="department">Department:</label>
        <select name="department" id="department">
            <option value="department1" <?php if ($department === 'department1') { echo 'selected'; } ?>>Department 1</option>
            <option value="department2" <?php if ($department === 'department2') { echo 'selected'; } ?>>Department 2</option>
        </select>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" min="<?= date('Y-m-d') ?>" value="<?= $start_date ?>" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" min="<?= date('Y-m-d') ?>" value="<?= $end_date ?>" required>

        <button type="submit">submit</button>
    </form>
</div>
<?php
   

}
