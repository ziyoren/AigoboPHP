<?php
/**
 * 7.6 获取保单保地址
 * 
 * 投保成功后可，查询获取保单文件地址。
 */
namespace ziyoren\AigoboPHP;

class PolicyUrl extends ApiRequest
{
    protected $apiUrl = '/api/policy/getPolicyUrl';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'tempOrderCode' => [true, 'String', '预订单接口返回的订单', '无', '预订单号', 60500],
        'memberId'      => [true, 'String', '107084', '无', '会员号', 60501],
        'distrCode'     => [true, 'String', '', '无', '分销商编号', 60502],
    ];
}