<?php

require_once 'init.php';
require_once 'dbconnect.php';
require_once 'userinfo.php';
require_once 'pages.php';

$signup_error = '';
if (array_key_exists('submit', $_POST)) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $email = trim($_POST['email']);
    $email2 = trim($_POST['email2']);
    if (@$_POST['tosok'] !== '1') {
        $signup_error .= "You must accept the terms of service. \n";
    }
    if (!is_valid_name($name)) {
        $signup_error .= "The name is not valid. It must be at least three characters. \n";
    }
    if ($email !== $email2) {
        $signup_error .= "The email address must be correct in both fields. \n";
    } else if (!is_valid_email($email)) {
        $signup_error .= "The email address does not seem valid. \n";
    }
    if ($password !== $password2) {
        $signup_error .= "The password must be the same in both fields. \n";
    } else if (!is_valid_password($password)) {
        $signup_error .= "The password is not valid (must be 6-72 characters.) \n";
    }
    if (!$signup_error) {
        $signup_error = user_register($name, $email, $password);
        if (!$signup_error) {
            redirect_to("/signupok.php");
        }
    }
}
require_once 'page/signup.php';

require_once 'finish.php';
