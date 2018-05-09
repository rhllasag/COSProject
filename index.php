<?php

require_once('Models/Requester.php');

$contacts = \qos\Models\Requester::getContacts();
$numContacts = \qos\Models\Requester::getContactsCount();

include('Views/landing_page.php');