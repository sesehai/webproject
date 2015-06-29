<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
define("ROOT_PATH", dirname(dirname(__FILE__)));

require_once ROOT_PATH.'/base.php';
spl_autoload_register(array('Base','auto_load'));

$qq_Gtimg = new Qq_Gtimg();
$codesAry = array(
    // 'sz300005',
    'sh600016',
    // 'sh600717',
    // 'sz300058',
    // 'sh603899',
    'sz300104',
    'sz000829',
    'sz002657',
);
$infosAry = $qq_Gtimg->getInfosByCode($codesAry);
$header = "";
foreach ($infosAry['header'] as $headerCol) {
    $header .= str_pad($headerCol, 30 - mb_strlen ($headerCol) , " ", STR_PAD_RIGHT);
}
foreach ($infosAry['body'] as $item) {
    $bodyColStr = "";
    foreach ($item as $bodyCol) {
        $bodyColStr .= str_pad($bodyCol, 30 - mb_strlen ($bodyCol) , " ", STR_PAD_RIGHT);
    }
    $body[] = $bodyColStr;
}

// echo $header."\n";
foreach ($body as $row) {
    echo $row."\n";
}
