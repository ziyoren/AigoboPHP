<?php

use PHPUnit\Framework\TestCase;
use ziyoren\AigoboPHP\MemberRegister;

class MemberRegisterTest extends TestCase
{


    public function testGetApiUrl()
    {
        $member = new MemberRegister();
        $this->assertEquals('/api/member/register', $member->getApiUrl() );
    }

    public function testGetParams()
    {
        $member = new MemberRegister();
        $config = require 'config.php';
        $data = [
            'distrCode'    => $config['distrCode'],
            'mobile'       => '13588822260',
            'employeeCode' => $config['employeeCode'],
            'invitateCode' => $config['invitateCode'],
            'company'      => '杭州智游网络科技有限公司',
            'province'     => '浙江省',
            'city'         => '杭州市',
            'contact'      => '山哥',
            'address'      => '浙江省杭州市西湖区',
        ];
        $member->setParams($data);
        $this->assertEquals($data, $member->getParams());
    }

    public function testSetParamsException()
    {
        $this->expectException('Exception');
        $this->expectDeprecationMessageMatches('/为必填项。/');
        $member = new MemberRegister();
        $config = require 'config.php';
        $data = [
            'distrCode'    => $config['distrCode'],
            'employeeCode' => $config['employeeCode'],
            // 'invitateCode' => $config['invitateCode'],
            'company'      => '杭州智游网络科技有限公司',
            'province'     => '浙江省',
            'city'         => '杭州市',
            'contact'      => '山哥',
            'address'      => '浙江省杭州市西湖区',
        ];
        $member->setParams($data);
    }
}