<?php

require_once('Logic/session_cleaner.php');
require_once('Models/Util.php');

if(empty($_SESSION['solved_duplicates'])) {
    echo json_encode(['status' => 400, 'message' => 'No solved duplicates to export']);
    exit();
}

$now = gmdate("D, d M Y H:i:s");
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
header("Last-Modified: {$now} GMT");

// force download
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// disposition / encoding on response body
header("Content-Disposition: attachment;filename=" . "solved_duplicates_" . date("Y-m-d") . ".csv");
header("Content-Transfer-Encoding: binary");
// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

$contacts = json_decode(json_encode($_SESSION['solved_duplicates']), true);

fputcsv($output, [
    'Guid',
    'Name',
    'Email',
    'Phone'
], ';');

foreach ($contacts as $contact) {
    fputcsv($output, [
        $contact['Guid'],
        $contact['GivenName']. ' ' . $contact['Surname'],
        implode($contact['Email'], ';'),
        implode($contact['Phone'], ';')
    ], ';');
}

// output the column headings
die();