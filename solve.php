<?php

require_once('Logic/session_cleaner.php');
require_once('Models/Util.php');

$repeated_field = $_POST['repeated_field'];
$repeated_field_key = $_POST['repeated_field_key'];

$contact = $_SESSION['contacts'][$repeated_field][$repeated_field_key];

$to_add = new \stdClass();
$to_add->Guid = $contact->users[0]->Guid;

$parsed_name = explode(' ', $_POST['name']);
$to_add->GivenName = $parsed_name[0];
$to_add->Surname = $parsed_name[1];
$to_add->Email = [];
$to_add->Phone = [];

foreach ($contact->users as $key => $user) {
    if(!empty($_POST['email_' . $key]) && $_POST['email_' . $key] == 'on') {
        $to_add->Email[] = $user->Email;
    }

    if(!empty($_POST['phone_' . $key]) && $_POST['phone_' . $key] == 'on') {
        $to_add->Phone[] = $user->Phone;
    }
}

$_SESSION['solved_duplicates'][] = $to_add;
unset($_SESSION['contacts'][$repeated_field][$repeated_field_key]);

header('Location: duplicate.php');