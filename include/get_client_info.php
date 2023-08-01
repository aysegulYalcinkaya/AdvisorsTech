<?php
require_once 'db_operations.php';

if (isset($_POST['clientId'])) {
    $clientId = $_POST['clientId'];
    $clientInfo = getClientInfoById($clientId);

    // Return the client information as a JSON response
    echo json_encode($clientInfo);
}