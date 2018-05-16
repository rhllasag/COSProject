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

    public static function renderContactsTable($table_path, $contacts) {
        ob_start();
        include($table_path);
        $contacts_table = ob_get_contents();
        ob_end_clean();

        return $contacts_table;
    }
}