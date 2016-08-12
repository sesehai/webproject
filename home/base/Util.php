<?php
//打时间标记， $flag 为标记名，默认为_default
function flagtime($flag = '_default') {
    static $static_time = array();
    if (!isset($static_time[$flag])) {
        $static_time[$flag] = microtime(true);
    }
    $diff = microtime(true) - $static_time[$flag];
    $static_time[$flag] = microtime(true);

    return substr(($diff * 1000) , 0, 5) . 'ms';
}
//存debug信息
function debugSet($string, $get = false) {
    if (!DEBUG)
    return '';
    static $debug_data = array();
    if ($get === true) {

        return $debug_data;
    }
    if (DEBUG) {
        $d = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
        $file = isset($d[0]['file']) ? basename($d[0]['file']) : 'unknown';
        $line = isset($d[0]['line']) ? $d[0]['line'] : 'unknown';
        $debug_data[] = $file . '(line ' . $line . '): ' . $string;
    }
}
//取debug信息
function debugGet() {

    return debugSet('', true);
}
