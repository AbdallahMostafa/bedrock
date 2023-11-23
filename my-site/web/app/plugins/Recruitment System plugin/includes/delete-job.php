<?php 
function deleteJob($job_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'jobs';

    // Check if the job ID is valid
    if ($job_id) {
        // Prepare the SQL query for deletion
        $sql = "DELETE FROM $table_name WHERE id = %d";
        $prepared_sql = $wpdb->prepare($sql, $job_id);

        // Delete the job from the database
        $wpdb->query($prepared_sql);

        // Return a success message
        return "<p>Job ID $job_id deleted successfully.</p>";

    } else {
        // Invalid job ID
        return "<p>Invalid job ID. Please provide a valid job ID.</p>";
    }
}