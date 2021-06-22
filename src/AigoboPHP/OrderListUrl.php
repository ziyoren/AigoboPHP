<?php
/**
 * 7.8 获取订单列表接口
 * 
 * 分销平台查看会员订单列表，首先请求改接口，接口返回一个url地址，之后分销平 台请求改地址即可查看订单列表。
 */
namespace ziyoren\AigoboPHP;

class OrderListUrl extends ApiRequest
{
    protected $apiUrl = '/api/order/getOrderListUrl';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'account'       => [true, 'String', '会员手机号', '无', '账号', 60650],
        'memberId'      => [true, 'String', '107084', '无', '会员号', 60651],
        'distrCode'     => [true, 'String', '', '无', '分销商编号', 60652],
    ];
}