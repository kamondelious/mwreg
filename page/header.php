<?php
function page_header($title) {
?><!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
<link rel='stylesheet' href='/mwreg/styles.css'/>
</head>
<body>
<div class='header'>
<?php
    global $user;
    if ($user) {
        $gravatar = calc_gravatar($user['email']);
        echo "<div class='userinfo'><span class='username'>".htmlquote($user[name])."</span><span class='action logout'><a href='/mwreg/logout.php'>Sign out</a></span></div>";
    } else {
        $gravatar = '';
        echo "<div class='loginlink'><span class='action login'><a href='/mwreg/signin.php'>Sign in</a></span><span class='action register'><a href='/mwreg/signup.php'>Sign up</a></span></div>";
    }
?>
    <a href='/mwreg'><?php echo "$gravatar$title"; ?></a>
</div><?php
}
?>
