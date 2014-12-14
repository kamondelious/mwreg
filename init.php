<?php

ob_start();

error_log("$_SERVER[REQUEST_METHOD] $_SERVER[REQUEST_URI] $_SERVER[REMOTE_ADDR]");

require_once 'config.php';

$_ver = explode('.', phpversion());
if ($_ver[0] < '5' || ($_ver[0] === '5' && $_ver[1] < '5')) {
    function _password_work($pw, $iter, $salt) {
        for ($i = 0; $i != $iter; ++$i) {
            $pw = strtolower(hash('sha256', "$i+$salt+$pw"));
        }
        return $pw;
    }
    function password_hash($pw) {
        $iter = 10;
        $salt = base64_encode(openssl_random_pseudo_bytes(32));
        return "x:$iter:$salt:"._password_work($pw, $iter, $salt);
    }
    function password_verify($pw, $hash) {
        list($alg, $iter, $salt, $expected) = explode(':', $hash);
        if (!$expected || !$pw) {
            return false;
        }
        return _password_work($pw, $iter, $salt) === $expected;
    }
}

function logerror() {
    $bta = array_slice(debug_backtrace(0), 0, 5);
    $bt = array();
    foreach ($bta as $i) {
        $args = $i['args'];
        if (array_key_exists("password", $args)) {
            $args['password'] = '******';
        }
        $bt[] = "$i[file]:$i[line]:$i[function](".
            implode(',', 
                array_map(function ($x) { return str_replace(array("\r", "\n"), ' ', var_export($x, true)); },
                $args)
            ).")";
    }
    $args = func_get_args();
    error_log(print_r(array('info'=>$args, 'backtrace'=>$bt), true));
}
