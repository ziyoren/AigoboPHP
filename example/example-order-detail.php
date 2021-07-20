<?php
require_once __DIR__ . '/autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\OrderDetail;

$config = require_once dirname(__DIR__) . '/test/config.php';

$agbApi = new AgbApi($config, $loger);

$oDetail = new OrderDetail();
$data = [
    'distrCode' => $agbApi->getDistrCode(),
    'memberId'  => 107084,
    // 'tempOrderCode' => '10102107121879001103',
    'tempOrderCode' => '10102107131911000100',
    // 'tempOrderCode' => '10102107134458000103',
    // 'tempOrderCode' => '10102107138362000104',
];
$oDetail->setParams($data);
$rst = $agbApi->execute($oDetail);

echo '结果：', PHP_EOL;
echo apiResponse($rst);
echo PHP_EOL; 