<?php

function get_csrf_input() {
    global $user;
    if ($user) {
        $time = time();
        $tok = hash_hmac('sha256', "$user[userid]:$time", "csrf prevention token secret");
        return "<input type='hidden' name='csrf' value='".htmlquote("$user[userid]:$time:$tok")."'/>";
    }
    return "";
}

function verify_csrf($csrf) {
    global $user;
    if (!$user) {
        return false;
    }
    list ($uid, $time, $hash) = explode(':', $csrf);
    if (!$hash) {
        return false;
    }
    if ($uid != $user['userid']) {
        return false;
    }
    $now = time();
    if (($now > ($time + 1200)) || ($now < ($time - 60))) {
        return false;
    }
    $tok = hash_hmac('sha256', "$user[userid]:$time", "csrf prevention token secret");
    if ($tok !== $hash) {
        return false;
    }
    return true;
}

function htmlquote($str) {
    return htmlentities($str, ENT_QUOTES | ENT_SUBSTITUTE);
}

function redirect_to($php) {
    global $URLHOST;
    global $ROOTPATH;
    header("Location: $URLHOST$ROOTPATH$php");
    require_once 'finish.php';
    exit();
}

function redirect_to_top() {
    redirect_to('/');
}

function formbtn($script, array $params, $name) {
    global $ROOTPATH;
    echo "<form class='button' method='post' action='$ROOTPATH/$script'>";
    echo get_csrf_input();
    foreacH ($params as $k => $v) {
        echo "<input type='hidden' name='".htmlquote($k)."' value='".htmlquote($v)."'/>";
    }
    echo "<button type='submit'>".htmlquote($name)."</button>";
    echo "</form>";
}
