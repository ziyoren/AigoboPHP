<?php
/**
 * 7.3 获取发票地址
 * 
 * 获取分销商订单发票地址
 */
namespace ziyoren\AigoboPHP;

class InvoiceUrl extends ApiRequest
{
    protected $apiUrl = '/api/order/getInvoiceUrl';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'memberId'     => [true, 'String', '107084', '无', '会员号', 60658],
        'orderCode'    => [true, 'String', '投保成功，回调返回的orderCode', '无', '订单号', 60659],
    ];
}