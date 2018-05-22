<?php

namespace qos\Models;

Class Util {
    public static function getFilteredContacts($facebook_active, $linked_in_active, $facebook_only, $linked_in_only) {
        $contacts_original = Requester::getContacts();
        $contacts = [];

        if (empty($contacts_original)) {
            return [];
        }

        foreach ($contacts_original as $contact) {
            if($contact->Source != 'Facebook' && $contact->Source != 'LinkedIn') {
                continue;
            }

            if($facebook_only || $linked_in_only) {
                if(($contact->Source == 'Facebook' && $linked_in_only)
                || $contact->Source == 'LinkedIn' && $facebook_only) {
                    continue;
                }
            } else {
                if (!$facebook_active && $contact->Source == 'Facebook') {
                    continue;
                }

                if (!$linked_in_active && $contact->Source == 'LinkedIn') {
                    continue;
                }
            }

            $contacts[] = $contact;
        }

        return $contacts;
    }

    public static function getDuplicates($contacts) {
        if (empty($contacts)) {
            return [];
        }

        $duplicates = [
            'Name' => [],
            'Phone' => [],
            'Email' => []
        ];

        foreach ($contacts as $key => $contact) {

            if (isset($duplicates['Name'][$contact->GivenName. ' ' . $contact->Surname])) {
                continue;
            }

            if (isset($duplicates['Phone'][$contact->Phone])) {
                continue;
            }

            if (isset($duplicates['Email'][$contact->Email])) {
                continue;
            }

            $obj = new \stdClass();
            $obj->counter = 0;
            $obj->users = [$contact];
            $duplicates['Name'][$contact->GivenName. ' ' . $contact->Surname] = $obj;

            $obj = new \stdClass();
            $obj->counter = 0;
            $obj->users = [$contact];
            $duplicates['Phone'][$contact->Phone] = $obj;

            $obj = new \stdClass();
            $obj->counter = 0;
            $obj->users = [$contact];
            $duplicates['Email'][$contact->Email] = $obj;

            foreach ($contacts as $key2 => $contact2) {

                // Do not compare with itself
                if($key == $key2) {
                    continue;
                }

                if (strcmp($contact->GivenName. ' ' . $contact->Surname, $contact2->GivenName. ' ' . $contact2->Surname) == 0) {
                    $duplicates['Name'][$contact2->GivenName. ' ' . $contact2->Surname]->counter++;
                    $duplicates['Name'][$contact2->GivenName. ' ' . $contact2->Surname]->users[] = $contact2;
                    //continue;
                }

                if (strcmp($contact->Email, $contact2->Email) == 0) {
                    $duplicates['Email'][$contact2->Email]->counter++;
                    $duplicates['Email'][$contact2->Email]->users[] = $contact2;
                    //continue;
                }

                if (strcmp($contact->Phone, $contact2->Phone) == 0) {
                    $duplicates['Phone'][$contact2->Phone]->counter++;
                    $duplicates['Phone'][$contact2->Phone]->users[] = $contact2;
                    //continue;
                }
            }
        }

        return $duplicates;
    }

    public static function generateCSV($contacts) {
        if (count($contacts) == 0) {
            return null;
        }

        $contacts = json_decode(json_encode($contacts), true);

        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($contacts)));

        foreach ($contacts as $row) {
            fputcsv($df, $row);
        }

        fclose($df);
        return ob_get_clean();
    }

    public static function renderContactsTable($table_path, $contacts) {
        ob_start();
        include($table_path);
        $contacts_table = ob_get_contents();
        ob_end_clean();

        return $contacts_table;
    }
}