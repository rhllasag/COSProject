<?php

require_once('Logic/session_cleaner.php');
require_once('Models/Util.php');

if ( isset($_GET['cancel']) ) {
    $repeated_field = $_GET['duplicate_field'];
    $repeated_field_key = $_GET['key'];

    $user = $_SESSION['contacts'][$repeated_field][$repeated_field_key]->users[0];

    $to_add = new \stdClass();
    $to_add->GivenName = $user->GivenName;
    $to_add->Surname = $user->Surname;
    $to_add->Email = [$user->Email];
    $to_add->Phone = [$user->Phone];
    $to_add->Birthday = [$user->Birthday];
    $to_add->Company = [$user->Company];
    $to_add->City = [$user->City];
    $to_add->Guid = $user->Guid;
    $to_add->Occupation = [$user->Occupation];
    $to_add->PhotoUrl = [$user->PhotoUrl];
    $to_add->Source = [$user->Source];
    $to_add->StreetAddress = [$user->StreetAddress];

    $_SESSION['solved_duplicates'][] = $to_add;
    unset($_SESSION['contacts'][$repeated_field][$repeated_field_key]);
    header('Location: duplicate.php');
    die();
}

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
    if(!empty($_POST['email_' . $key])) {
        $to_add->Email[] = $user->Email;
    }

    if(!empty($_POST['phone_' . $key])) {
        $to_add->Phone[] = $user->Phone;
    }

    if(!empty($_POST['photourl_' . $key])) {
        $to_add->PhotoUrl[] = $user->PhotoUrl;
    }

    if(!empty($_POST['birthday_' . $key])) {
        $to_add->Birthday[] = $user->Birthday;
    }

    if(!empty($_POST['company_' . $key])) {
        $to_add->Company[] = $user->Company;
    }

    if(!empty($_POST['city_' . $key])) {
        $to_add->City[] = $user->City;
    }

    if(!empty($_POST['occupation_' . $key])) {
        $to_add->Occupation[] = $user->Occupation;
    }

    if(!empty($_POST['source_' . $key])) {
        $to_add->Source[] = $user->Source;
    }

    if(!empty($_POST['streetaddress_' . $key])) {
        $to_add->StreetAddress[] = $user->StreetAddress;
    }
}

$_SESSION['solved_duplicates'][] = $to_add;
unset($_SESSION['contacts'][$repeated_field][$repeated_field_key]);

header('Location: duplicate.php');