<?php
include 'models.php';

// Define a map of request IDs to method names
$methodMap = [
    'create_child' => 'create_child',
    'read_all_children' =>'read_all_children',
    'count_children' => 'count_children',
    'get_child_by_id' => 'get_child_by_id',
    'update_child_info' => 'update_child_info',
    'delete_child' => 'delete_child',
    'get_abuse_types' => 'get_abuse_types',
    'get_abuse_names' => 'get_abuse_names',
    'create_abuse' => 'create_abuse',
    'get_abuse_records' => 'get_abuse_records',
    'get_abuse_by_id' => 'get_abuse_by_id',
    'update_abuse_info'=> 'update_abuse_info',
    'delete_abuse' => 'delete_abuse',
    'count_abuses' => 'count_abuses',
    'add_admin' => 'add_admin',
    'toggle_status' => 'toggle_status',
    'login_request' => 'login_request',
    'logout_request' => 'logout_request',
    'load_admin_data' => 'load_admin_data',
    'update_admin' => 'update_admin',

    // Add more mappings as needed
];

// Check if the request ID is in the map
$requestId = $_POST['request_id'];

if (isset($methodMap[$requestId])) {
    // Get the corresponding method name
    $methodName = $methodMap[$requestId];

    // Create an instance of Models
    $db_queries = new Models();

    // Check if the method exists in the Models class
    if (method_exists($db_queries, $methodName)) {
        // Call the method with the POST data
        $result = $db_queries->$methodName($_POST);
        print($result);
    } else {
        // Handle the case where the method doesn't exist
        error_log('Method does not exist', 0);
        throw new Exception('An error occurred');
    }
} else {
    // Handle the case where the request ID is not recognized
    error_log('Invalid request ID', 0);
    throw new Exception('An error occurred');
}
