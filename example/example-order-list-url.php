<?php
require_once __DIR__ . '/autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\OrderListUrl;

$config = require_once dirname(__DIR__) . '/test/config.php';

$agbApi = new AgbApi($config, $loger);

$orderList = new OrderListUrl();
$data = [
    'distrCode' => $agbApi->getDistrCode(),
    'memberId'  => 107084,
    'account' => '13588822260',
];
$orderList->setParams($data);
$rst = $agbApi->execute($orderList);

echo '结果：', PHP_EOL;
echo json_encode($rst, 256|128|JSON_UNESCAPED_SLASHES);
echo PHP_EOL; 