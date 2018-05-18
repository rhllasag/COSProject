<?php

require_once('Models/Requester.php');
require_once('Models/Util.php');
require_once('Logic/session_cleaner.php');

//
// AJAX REQUEST
//
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


        $facebook_only = !empty($_SESSION['facebook_only']) && $_SESSION['facebook_only'] === true;
        $linked_in_only = !empty($_SESSION['linked_in_only']) && $_SESSION['linked_in_only'] === true;


        if (!empty($_GET['facebook_only'])) {
            $_SESSION['facebook_only'] = true;
            $facebook_only = true;

            if (!empty($_SESSION['linked_in_only'])) {
                unset($_SESSION['linked_in_only']);
            }

            $linked_in_only = false;
        } elseif (!empty($_GET['linked_in_only'])) {
            $_SESSION['linked_in_only'] = true;
            $linked_in_only = true;

            if (!empty($_SESSION['facebook_only'])) {
                unset($_SESSION['facebook_only']);
            }
            $facebook_only = false;
        }

        if (!empty($_GET['show_all'])) {
            if (!empty($_SESSION['facebook_only'])) {
                unset($_SESSION['facebook_only']);
            }

            if (!empty($_SESSION['linked_in_only'])) {
                unset($_SESSION['linked_in_only']);
            }

            $facebook_only = false;
            $linked_in_only = false;
        }

        $contacts = qos\Models\Util::getFilteredContacts($facebook_active, $linked_in_active, $facebook_only, $linked_in_only);
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

$facebook_only = false;
$linked_in_only = false;

if (!empty($_SESSION['facebook_only']) && $_SESSION['facebook_only']) {
    $facebook_only = true;
}

if (!empty($_SESSION['linked_in_only']) && $_SESSION['linked_in_only']) {
    $linked_in_only = true;
}

// Contacts
$contacts = qos\Models\Util::getFilteredContacts($facebook_active, $linked_in_active, $facebook_only, $linked_in_only);
$numContacts = empty($contacts) ? 0 : count($contacts);

$contacts_table = \qos\Models\Util::renderContactsTable('Views/contacts_table.php', $contacts);

include('Views/landing_page.php');