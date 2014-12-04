<?php

require_once 'init.php';
require_once 'dbconnect.php';
require_once 'userinfo.php';
require_once 'pages.php';

if (array_key_exists('name', $_POST)) {
    $forgot_message = send_user_name_email_reminder($_POST['name']);
    if (!$forgot_message) {
        $forgot_message = 'An e-mail message was sent to the registered e-mail address for the name.';
    }
} else if (array_key_exists('email', $_POST)) {
    $forgot_message = send_user_password_reset($_POST['email']);
    if (!$forgot_message) {
        $forgot_message = 'An e-mail message was sent to the e-mail address with a link for re-setting the password.';
    }
}
require_once 'page/forgot.php';

require_once 'finish.php';
