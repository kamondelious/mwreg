<?php

require_once 'init.php';
require_once 'dbconnect.php';
require_once 'userinfo.php';
require_once 'pages.php';

$signin_error = null;

if (array_key_exists('submit', $_POST)) {
    if (user_signin(trim($_POST['name']), trim($_POST['password']))) {
        redirect_to_top();
    }
    $signin_error = 'Unable to sign in. Did you forget your password?';
}
require_once 'page/signin.php';

require_once 'finish.php';
