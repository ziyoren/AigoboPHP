<?php

use PHPUnit\Framework\TestCase;
use ziyoren\AigoboPHP\ApplyInvoice;

class ApplyInvoiceTest extends TestCase
{


    public function testGetApiUrl()
    {
        $applyInvoice = new ApplyInvoice();
        $this->assertEquals('/api/order/applyInvoice', $applyInvoice->getApiUrl() );
    }

    public function testGetParams()
    {
        $applyInvoice = new ApplyInvoice();
        $data = [
            'memberId'     => 107084,
            'orderCode'    => 'D123456',
            'invoiceType'  => 1,
            'invoiceTitle' => '山哥',
        ];
        $applyInvoice->setParams($data);
        $this->assertEquals($data, $applyInvoice->getParams());
    }

    public function testInvoiceTypeException()
    {
        $this->expectException('Exception');
        $this->expectDeprecationMessage('纳税人识别号(taxpayerNo)为必填项。');
        $applyInvoice = new ApplyInvoice();
        $data = [
            'memberId'     => 107084,
            'orderCode'    => 'D123456',
            'invoiceType'  => 2,
            'invoiceTitle' => '山哥',
            // 'taxpayerNo'   => '123',
        ];
        $applyInvoice->setParams($data);
    }
}