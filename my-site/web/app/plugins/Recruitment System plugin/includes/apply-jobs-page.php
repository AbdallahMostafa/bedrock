<?php 

add_action('admin_menu', 'custom__apply_jobs');
include_once plugin_dir_path(__FILE__) . 'job-application-endpoint.php';

function custom__apply_jobs() {
    $job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;

    ?>
    <div>       
        <title>Job Application Form</title>

        <form action="/recruitment/v1/apply" method="post">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="job_id">Job ID:</label>
            <input type="number" id="job_id" name="job_id" value="<?php $job_id ?>" required>

            <button type="submit">Submit Application</button>
        </form>
    </div>
<?php
   

}
