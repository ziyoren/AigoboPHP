<?php
$basePath = dirname(__DIR__);
require_once $basePath . '/src/AigoboPHP/AgbApi.php';

use ziyoren\AigoboPHP\AgbApi;

$config = require_once $basePath . '/test/config.php';

$str = ['message' => '感谢使用智游科技的产品'];
//下面的密文通过(http://tool.chacuo.net/cryptdes)获取 DES/ECB/PKCS5PADDING
$encode = 'eGaJCrP3EH7ldpo+ZNF6EccgYWObnXpO7W7mdttfJHY2qaB3QEtbVwzbkE1exBKN';

$agb  = new AgbApi($config);
$code = $agb->getRequestBody($str);

echo 'PHP Version: ', PHP_VERSION, PHP_EOL;
echo $encode, PHP_EOL;
echo $code, PHP_EOL;
echo json_encode( $code == $encode ), PHP_EOL, PHP_EOL;
