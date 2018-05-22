<?php

require_once('Models/Requester.php');
require_once('Models/Util.php');
require_once('Logic/session_cleaner.php');


if (!empty($_SESSION['contacts'])) {
    $duplicates = $_SESSION['contacts'];
    $solved_duplicates = $_SESSION['solved_duplicates'];
} else {
    $contacts = qos\Models\Util::getFilteredContacts(true, true, false, false);
    $duplicates = qos\Models\Util::getDuplicates($contacts);
    $_SESSION['contacts'] = $duplicates;
    $_SESSION['solved_duplicates'] = [];
    $solved_duplicates = [];
}

include('Views/duplicates.php');