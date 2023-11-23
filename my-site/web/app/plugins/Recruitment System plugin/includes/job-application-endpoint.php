<?php
// API endpoint
add_action('rest_api_init', 'register_job_application_endpoint');

function register_job_application_endpoint() {
    register_rest_route('recruitment/v1', '/apply', array(
        'methods' => 'POST',
        'callback' => 'handle_job_application',
    ));
}

function handle_job_application($request) {

    // Retrieve parameters from the request body
    $parameters = $request->get_json_params();

    // Validate and sanitize input data
    $email = sanitize_email($parameters['email']);
    $job_id = absint($parameters['job_id']);


    // Save application to the database
    global $wpdb;
    $table_name = $wpdb->prefix . 'applied_users';
    $wpdb->insert(
        $table_name,
        array(
            'email' => $email,
            'job_id' => $job_id,
        )
    );

    // Return a response
    return new WP_REST_Response(array('message' => 'Application submitted successfully'), 200);
}
