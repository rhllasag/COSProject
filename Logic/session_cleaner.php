<?php

namespace qos\Logic;

if (!empty($_GET['clear_session'])) {
    if (!empty($_SESSION['facebook_only'])) {
        unset($_SESSION['facebook_only']);
    }

    if (!empty($_SESSION['linked_in_only'])) {
        unset($_SESSION['linked_in_only']);
    }

    if (!empty($_SESSION['facebook_active'])) {
        unset($_SESSION['facebook_active']);
    }

    if (!empty($_SESSION['linked_in_active'])) {
        unset($_SESSION['linked_in_active']);
    }
}