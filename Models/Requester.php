<?php

namespace qos\Models;

class Requester {
    private static $base_url = "http://contactsqs2.apphb.com/Service.svc/rest";

    public static function send($url, $method) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json'));
        $result = curl_exec($ch);
        if (curl_error($ch)) {
            printf("%s\ncurl error: %s".PHP_EOL, $url, curl_error($ch));
            exit(1);
        }
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($code != 200) {
            printf("non 200 response: %d".PHP_EOL.'%s'.PHP_EOL, $code, $result);
            exit(2);
        }
        curl_close($ch);
        
        return json_decode($result);
    }

    public static function getContacts() {
        return self::send(self::$base_url . 'rest/contacts', 'GET');
    }

    public static function getContactsShort() {
        return self::send(self::$base_url . '/contacts/short', 'GET');
    }

    public static function getContactsCount() {
        return self::send(self::$base_url . '/contacts/count', 'GET');
    }

    public static function getContactByName($name) {
        return self::send(self::$base_url . '/contact/byname/' . $name, 'GET');
    }

    public static function getContactById($id) {
        return self::send(self::$base_url . 's/contact/byguid/' . $id, 'GET');
    }
}