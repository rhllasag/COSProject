<?php

namespace qos\Logic;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_GET['clear_session'])) {
    if (isset($_SESSION['contacts'])) {
        unset($_SESSION['contacts']);
    }

    if (isset($_SESSION['solved_duplicates'])) {
        unset($_SESSION['solved_duplicates']);
    }

    if (isset($_SESSION['facebook_only'])) {
        unset($_SESSION['facebook_only']);
    }

    if (isset($_SESSION['linked_in_only'])) {
        unset($_SESSION['linked_in_only']);
    }

    if (isset($_SESSION['facebook_active'])) {
        unset($_SESSION['facebook_active']);
    }

    if (isset($_SESSION['linked_in_active'])) {
        unset($_SESSION['linked_in_active']);
    }
}