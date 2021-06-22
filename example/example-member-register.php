<?php
require_once './autoload.php';

use ziyoren\AigoboPHP\AgbApi;
use ziyoren\AigoboPHP\MemberRegister;

$config = require_once '../test/config.php';

$agbApi = new AgbApi($config);

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
print_r($rst);
echo PHP_EOL;