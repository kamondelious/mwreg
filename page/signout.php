<?php

setcookie('session', null, 0, '/mwreg/', '.watte.net', false, true);
header('Location: /mwreg/');
