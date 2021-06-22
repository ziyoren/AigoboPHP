<?php
/**
 * 7.10 根据订单号退保
 * 
 * 根据爱购保平台订单号进行退保
 */
namespace ziyoren\AigoboPHP;

class SurrenderByOrderCode extends ApiRequest
{
    protected $apiUrl = '/api/policy/surrenderByOrderCode';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'orderCode'    => [true, 'String', '订单Code，是爱购保平台返回的订单号', '无', '订单号', 60510],
        'memberId'     => [true, 'String', '107084', '无', '会员号', 60511],
        'distrCode'    => [true, 'String', '', '无', '分销商编号', 60512],
    ];
}