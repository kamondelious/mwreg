<?php

require_once 'init.php';
require_once 'dbconnect.php';
require_once 'userinfo.php';
require_once 'pages.php';

$email = @$_GET['email'];
$code = @$_GET['code'];
$verify_error = "The verification failed. Please make sure you're clicking the exact URL from the verification email.";
if ($email && $code) {
    if (verify_user($email, $code)) {
        $verify_error = '';
    }
}
require_once 'page/verifyok.php';

require_once 'finish.php';
