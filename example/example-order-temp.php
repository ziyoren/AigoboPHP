<?php
require_once './autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\OrderTemp;

$config = require_once '../test/config.php';

$agbApi = new AgbApi($config);

$order = new OrderTemp();
$data = [
    'distrCode'    => $agbApi->getDistrCode(),
    'mobile'       => '13588822260',
    'memberId'     => '107084',
    'outSerialNo'  => 'GP20218811000005',
    'payType'      => '2',
    'productCode'  => '200437',
    'productName'  => '太平洋安游神州境内险', 
    'deliverNotifyUrl' => 'http://office.ziyo.ren:9090/index/deliver',
    'returnNotifyUrl'  => 'http://office.ziyo.ren:9090/index/return',
    'refundNotifyUrl'  => 'http://office.ziyo.ren:9090/index/refund',
    'returnPage'       => 'http://office.ziyo.ren:9090/index/return_page',
    // 'holderInfo'       => [],
    // 'insuredInfoList'  => [],
];
$order->setParams($data);
$rst = $agbApi->execute($order);

echo '结果：', PHP_EOL;
print_r($rst);
echo PHP_EOL;