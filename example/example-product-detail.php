<?php
require_once __DIR__ . '/autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\ProductDetail;

$config = require_once dirname(__DIR__) . '/test/config.php';

$agbApi = new AgbApi($config, $loger);

$pd = new ProductDetail();
$pd->setParams(['productCode' => '200437', 'memberId'=> '107084']);
$rst = $agbApi->execute($pd);

echo '结果：', PHP_EOL;
echo apiResponse($rst);
echo PHP_EOL;