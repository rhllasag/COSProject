<?php

require_once('Models/Requester.php');
require_once('Models/Util.php');

session_start();

//
// AJAX REQUEST
//
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    header('Content-Type: application/json');
    $string = str_replace('/', '', $_SERVER['REQUEST_URI']);
    $uri = substr($string, 0, strpos($string, '?'));

    if ($uri == 'getContacts') {
        $facebook_active = !empty($_GET['facebook_selected']) && $_GET['facebook_selected'] === 'true';
        $linked_in_active = !empty($_GET['linked_in_selected']) && $_GET['linked_in_selected'] === 'true';

        $_SESSION['facebook_active'] = $facebook_active;
        $_SESSION['linked_in_active'] = $linked_in_active;

        $contacts = qos\Models\Util::getFilteredContacts($facebook_active, $linked_in_active);
        $numContacts = count($contacts);
        $contacts_table = \qos\Models\Util::renderContactsTable('Views/contacts_table.php', $contacts);

        echo json_encode([
            'html' => $contacts_table,
            'numContacts' => $numContacts
        ]);
        return;
    }
}

//
// NORMAL REQUEST
//

// Session variables
if (!isset($_SESSION['facebook_active'])) {
    $_SESSION['facebook_active'] = true;
}
$facebook_active = $_SESSION['facebook_active'];

if (!isset($_SESSION['linked_in_active'])) {
    $_SESSION['linked_in_active'] = true;
}
$linked_in_active = $_SESSION['linked_in_active'];

// Contacts
$contacts = qos\Models\Util::getFilteredContacts($facebook_active, $linked_in_active);
$numContacts = empty($contacts) ? 0 : count($contacts);

$contacts_table = \qos\Models\Util::renderContactsTable('Views/contacts_table.php', $contacts);

include('Views/landing_page.php');