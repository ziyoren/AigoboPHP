<?php
require_once './autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\OrderListUrl;

$config = require_once '../test/config.php';

$agbApi = new AgbApi($config);

$orderList = new OrderListUrl();
$data = [
    'distrCode' => $agbApi->getDistrCode(),
    'memberId'  => 107084,
    'account' => '13588822260',
];
$orderList->setParams($data);
$rst = $agbApi->execute($orderList);

echo '结果：', PHP_EOL;
print_r($rst);
echo PHP_EOL; 