<?php

use PHPUnit\Framework\TestCase;
use ziyoren\AigoboPHP\AgbApi;

class AgbApiTest extends TestCase
{

    public function testConfigException()
    {
        $this->expectException('Exception');
        $this->expectDeprecationMessageMatches('/不能为空/');
        $config = $this->configProvider();
        unset($config['host']); //模拟缺少定义必要的配置项
        $api = new AgbApi($config);
    }


    public function testGetCode()
    {
        $config = $this->configProvider();
        $api = new AgbApi($config);
        $this->assertEquals($config['distrCode'], $api->getDistrCode() );
        $this->assertEquals($config['employeeCode'], $api->getEmployeeCode() );
        $this->assertEquals($config['invitateCode'], $api->getInvitateCode() );
    }

    public function testGetRequestBody()
    {
        $str = ['message' => '感谢使用智游科技的产品'];
        //下面的密文通过(http://tool.chacuo.net/cryptdes)获取 DES/ECB/PKCS5PADDING
        $encode = 'eGaJCrP3EH7ldpo+ZNF6EccgYWObnXpO7W7mdttfJHY2qaB3QEtbVwzbkE1exBKN';
        $config = $this->configProvider();
        $api = new AgbApi($config);
        $this->assertEquals($encode, $api->getRequestBody($str));
    }

    public function configProvider()
    {
        return require __DIR__ . '/config.php';
    }
}