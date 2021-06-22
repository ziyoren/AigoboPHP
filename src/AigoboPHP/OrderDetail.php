<?php
/**
 * 7.11 查询订单详情
 * 
 * 根据分销商订单号、会员号、渠道号查询订单详情
 */

namespace ziyoren\AigoboPHP;

class OrderDetail extends ApiRequest
{
    protected $apiUrl = '/api/order/getOrderDetail';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'distrCode'     => [true, 'String', 'DL1000100', '无', '分销商编号(爱购保平台提供)', 60655],
        'memberId'      => [true, 'String', '107084', '无', '会员号', 60656],
        'tempOrderCode' => [true, 'String', '下预订单返回的', '无', '预订单号', 60657],
    ];
}