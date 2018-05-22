<?php

require_once('Models/Requester.php');
require_once('Logic/session_cleaner.php');

if (empty($_GET['id'])) {
    echo json_encode(['status' => 400, 'message' => 'User guid is required']);
    return;
}

$contact = \qos\Models\Requester::getContactById($_GET['id']);

if (!$contact) {
    echo json_encode(['status' => 404, 'message' => 'User not found']);
    return;
} else {
    include('Views/contact_info.php');
}