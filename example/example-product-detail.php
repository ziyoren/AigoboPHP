<?php
require_once './autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\ProductDetail;

$config = require_once '../test/config.php';

$agbApi = new AgbApi($config);

$pd = new ProductDetail();
$pd->setParams(['productCode' => '200437', 'memberId'=> '107084']);
$rst = $agbApi->execute($pd);

echo '结果：', PHP_EOL;
print_r($rst);
echo PHP_EOL;