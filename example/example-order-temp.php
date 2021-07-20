<?php
require_once __DIR__ . '/autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\OrderTemp;

$config = require_once dirname(__DIR__) . '/test/config.php';


$agbApi = new AgbApi($config, $loger);

$order = new OrderTemp();
$outSerialNo = 'GP20218811000018';
$data = [
    'distrCode'    => $agbApi->getDistrCode(),
    'mobile'       => '13588822260',
    'memberId'     => '107084',
    'outSerialNo'  => $outSerialNo,
    'payType'      => '2',
    'productCode'  => '200437',
    'productName'  => '太平洋安游神州境内险', 
    'deliverNotifyUrl' => 'http://office.ziyo.ren:9090/index/deliver',
    'returnNotifyUrl'  => 'http://office.ziyo.ren:9090/index/return',
    'refundNotifyUrl'  => 'http://office.ziyo.ren:9090/index/refund',
    'returnPage'       => 'http://office.ziyo.ren:9090/index/return_page?no=' . $outSerialNo,
    'safeguardStartTime' => '2021-07-18',
    'safeguardEndTime'   => '2021-07-18',
    'holderInfo'       => [
        'holderName' => '廖建山',
        'holderCardType' => '1',
        'holderCardNo' => '330124197910103311',
        'holderBirthday' => '1979-10-10',
        'holderGender' => 'M',
        'holderMobile' => '18968022050',
        'holderEmail' => 'asun@66580.cn'
    ],
    'insuredInfoList'  => [
        [
            'insuredName'     => '廖建山',
            'insuredCardType' => '1',
            'insuredCardNo'   => '330124197910103311',
            'insuredBirthday' => '1979-10-10',
            'insuredGender'   => 'M',
            // 'insuredMobile'   => '',
            // 'insuredEmail'    => '',
            // 'insuredRelation' => '5',
        ],
    ],
];
// echo json_encode($data, 256|JSON_UNESCAPED_SLASHES), PHP_EOL;

$order->setParams($data);
$rst = $agbApi->execute($order);

echo '结果：', PHP_EOL;
echo apiResponse($rst);
echo PHP_EOL;