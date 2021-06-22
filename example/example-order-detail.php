<?php
require_once './autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\OrderDetail;

$config = require_once '../test/config.php';

$agbApi = new AgbApi($config);

$oDetail = new OrderDetail();
$data = [
    'distrCode' => $agbApi->getDistrCode(),
    'memberId'  => 107084,
    'tempOrderCode' => 'TE2106212635000100',
];
$oDetail->setParams($data);
$rst = $agbApi->execute($oDetail);

echo '结果：', PHP_EOL;
print_r($rst);
echo PHP_EOL; 