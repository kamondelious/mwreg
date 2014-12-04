<?php

require_once 'init.php';
require_once 'dbconnect.php';
require_once 'userinfo.php';
require_once 'pages.php';

if (!$user) {
    redirect_to_top();
}
$profile_error = '';
$_submit = @$_POST['submit'];
if ($_submit) {
    if (!verify_csrf(@$_POST['csrf'])) {
        $profile_error = 'There server detected a validation error. Please verify the values and try again. Also note that forms time out after a while.';
        $_submit = '';
    }
}
if ($_submit == 'name') {
    $_name = trim(@$_POST['name']);
    if (!is_valid_name($_name)) {
        $profile_error = 'That is not a valid name.';
    } else if (!user_change_name($user, $_name)) {
        $profile_error = "Name change failed. The name is probably already taken, or you have already changed your name three times this month.";
    } else {
        $user['name'] = $_name;
        $name_ok = "The name has been changed.";
    }
} else if ($_submit == 'email') {
    $_email = trim(@$_POST['email']);
    $_email2 = trim(@$_POST['email2']);
    if ($_email != $_email2) {
        $profile_error = 'The e-mail addresses must match, to avoid typos.';
    } else if (!is_valid_email($_email)) {
        $profile_error = 'That is not a valid e-mail address.';
    } else if (!user_change_email($user, $_email)) {
        $profile_error = "E-mail change failed. The e-mail address is probably already taken, or you have already changed your e-mail address three times this month.";
    } else {
        $user['email'] = $_email;
        $email_ok = "A verification email is on its way to your inbox.";
    }
} else if ($_submit == 'password') {
    $_curpw = trim(@$_POST['curpw']);
    $_newpw = trim(@$_POST['newpw']);
    $_newpw2 = trim(@$_POST['newpw2']);
    if (!password_verify($_curpw, $user['passwordhash'])) {
        $profile_error = 'The current password was not entered correctly.';
    } else if (!is_valid_password($_newpw)) {
        $profile_error = 'The new password is not allowed. It must be between 6 and 72 characters long.';
    } else if ($_newpw != $_newpw2) {
        $profile_error = 'The new password was not entered the same in both fields.';
    } else if (!user_change_password($user, $_newpw)) {
        $profile_error = 'There was an error changing the password. Please try resetting the password using the Forgot Password link.';
    } else {
        $password_ok = "The password has been changed.";
    }
} else if ($_submit) {
    $profile_error = 'Unknown profile operation: '.$_submit;
}
require_once 'page/profile.php';

require_once 'finish.php';
