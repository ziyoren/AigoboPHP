<?php
/**
 * 7.4下预订单
 * 
 * 通过下预订单，跳转到爱购保平台页面进行投保
 */
namespace ziyoren\AigoboPHP;

class OrderTemp extends ApiRequest
{
    protected $apiUrl = '/api/order/addTemp';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'distrCode'    => [true, 'String', 'DL1000100', '无', '分销商编号(爱购保平台提供)', 60600],
        'mobile'       => [true, 'String', '13600001111', '无', '会员手机号', 60601],
        'memberId'     => [true, 'String', '107084', '无', '会员号', 60602],
        'outSerialNo'  => [true, 'String', 'GP20218811000001', '无', '外部流水号', 60603],
        'payType'      => [true, 'String', '2', '2', '支付方式', 60604],
        'productCode'  => [true, 'String', '200437', '无', '产品编号', 60605],
        'productName'  => [true, 'String', '太平洋安游神州境内险', '无', '产品名称', 60606],
        'deliverNotifyUrl' => [true, 'String', 'http://www.66580.cn', '无', '投保回调url', 60607],
        'returnNotifyUrl'  => [true, 'String', 'http://www.66580.cn', '无', '退保回调url', 60608],
        'refundNotifyUrl'  => [true, 'String', 'http://www.66580.cn', '无', '退款回调url', 60609],
        'returnPage'       => [true, 'String', 'http://www.66580.cn', '无', '返回页面地址', 60610],
        'holderInfo'       => [false, 'Array', '', '无', '投保人信息', 60611],
        'insuredInfoList'  => [false, 'Array', '', '无', '被保人信息', 60612],
    ];
}