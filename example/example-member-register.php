<?php
require_once __DIR__ . '/autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\MemberRegister;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$loger  = new Logger('example');
$streamHandler = new StreamHandler(dirname(__DIR__). '/logs/example-'. date('Y_m_d') .'.log', Logger::DEBUG);
$loger->pushHandler( $streamHandler );

$config = require_once dirname(__DIR__) . '/test/config.php';

$agbApi = new AgbApi($config, $loger);

$member = new MemberRegister();
$data = [
    'distrCode'    => $agbApi->getDistrCode(),
    'mobile'       => '13588822260',
    'employeeCode' => $agbApi->getEmployeeCode(),
    'invitateCode' => $agbApi->getInvitateCode(),
    'company'      => '杭州智游网络科技有限公司',
    'province'     => '浙江省',
    'city'         => '杭州市',
    'contact'      => '山哥',
    'address'      => '浙江省杭州市西湖区',
];
$member->setParams($data);
$rst = $agbApi->execute($member);

echo '结果：', PHP_EOL;
echo apiResponse($rst);
echo PHP_EOL;