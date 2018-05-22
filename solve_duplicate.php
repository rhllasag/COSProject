<?php

require_once('Logic/session_cleaner.php');
require_once('Models/Util.php');

$repeated_field = $_GET['duplicate_field'];
$k = $_GET['key'];

$contacts = $_SESSION['contacts'];
$repeated = $_SESSION['contacts'][$repeated_field][$k];

require('Views/solve_duplicate.php');