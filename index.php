<?php

require_once('Models/Requester.php');

$contacts = \qos\Models\Requester::getContacts();

include('Views/landing_page.php');