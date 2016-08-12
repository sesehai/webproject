<?php
define('VERSION','1.0.0');
define('STATUS_OK', 1); //成功

//debug
if (isset($_GET['_debug']) && $_GET['_debug'] == 1) {
    define('DEBUG', true);
} else {
    define('DEBUG', false);
}
//flush
if (isset($_GET['flush']) && $_GET['flush'] == 1) {
    define('FLUSH', true);
} else {
    define('FLUSH', false);
}

?>