<?php

require_once('Logic/session_cleaner.php');
require_once('Models/Util.php');

if(empty($_SESSION['contacts']) && empty($_SESSION['solved_duplicates'])) {
    echo json_encode(['status' => 400, 'message' => 'No contacts to export']);
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

$duplicate_guids = [];
$solved_duplicates = json_decode(json_encode($_SESSION['solved_duplicates']), true);
$contacts = \qos\Models\Util::getFilteredContacts(true, true, false, false);

foreach ($solved_duplicates as $d) {
    $duplicate_guids[] = $d['Guid'];
}

$payload = [];

foreach ($contacts as $contact) {
    if(in_array($contact->Guid, $duplicate_guids)) {
        continue;
    }

    $contact->Email = [$contact->Email];
    $contact->Phone = [$contact->Phone];
    $contact->PhotoUrl = [$contact->PhotoUrl];
    $contact->Birthday = [$contact->Birthday];
    $contact->Company = [$contact->Company];
    $contact->City = [$contact->City];
    $contact->Occupation = [$contact->Occupation];
    $contact->Source = [$contact->Source];
    $contact->StreetAddress = [$contact->StreetAddress];
    $payload[] = json_decode(json_encode($contact), true);
}


$contacts_list = array_merge($payload, $solved_duplicates);

fputcsv($output, [
    'Guid',
    'Name',
    'Email',
    'Phone',
    'PhotoUrl',
    'Birthday',
    'Company',
    'City',
    'Occupation',
    'Source',
    'StreetAddress'
], ';');

foreach ($contacts_list as $contact) {
    fputcsv($output, [
        $contact['Guid'],
        $contact['GivenName']. ' ' . $contact['Surname'],
        implode($contact['Email'], '|'),
        implode($contact['Phone'], '|'),
        implode($contact['PhotoUrl'], '|'),
        implode($contact['Birthday'], '|'),
        implode($contact['Company'], '|'),
        implode($contact['City'], '|'),
        implode($contact['Occupation'], '|'),
        implode($contact['Source'], '|'),
        implode($contact['StreetAddress'], '|')
    ], ';');
}

// output the column headings
die();