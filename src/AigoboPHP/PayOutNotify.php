<?php
/**
 * 7.7 第三方支付回调接口
 * 
 * 分销商支付成功异步通知爱购保应用服务器，爱购保平台根据返回交易状态发送扣 减信用账户余额，和发送投保指令。
 */

namespace ziyoren\AigoboPHP;

class PayOutNotify extends ApiRequest
{
    protected $apiUrl = '/api/pay/outNotify';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'tempOrderCode' => [true, 'String', '预订单接口返回的订单', '无', '预订单号', 60800],
        'txnStatus'     => [true, 'int', '会员手机号', '无', '交易状态', 60801],
        'memberId'      => [true, 'String', '107084', '无', '会员号', 60902],
        'distrCode'     => [true, 'String', '', '无', '分销商编号', 60803],
    ];
}