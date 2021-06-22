<?php
/**
 * 7.2 开票
 *  
 * 分销商订单开票
 */
namespace ziyoren\AigoboPHP;

class ApplyInvoice extends ApiRequest
{
    protected $apiUrl = '/api/order/applyInvoice';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认值', '4参数描述', '5错误代码']
        'memberId'     => [true, 'String', '107084', '', '会员号', 60640],
        'orderCode'    => [true, 'String', '', '无', '订单号', 60641],
        'invoiceType'  => [true, 'String', '发票类型：1个人; 2公司', '2', '发票类型', 60642],
        'invoiceTitle' => [true, 'String', '杭州智游网络科技有限公司', '', '发票抬头', 60643],
        'taxpayerNo'  => [false, 'String', '发票类型是公司时，必传', '', '纳税人识别号', 60644],
    ];


    public function setParams($key, $value = null)
    {
        $keys = array_keys($this->allowParams);
        if (is_string($key)){
            $data[$key] = $value;
        }else if (is_array($key)) {
            $data = $key;
        }else {
            throw new \Exception('非法的参数类型。', 50000);
        }
        if (isset($data['invoiceType']) && $data['invoiceType'] == '2') {
            $this->allowParams['taxpayerNo'][0] = true;
        }
        foreach ($keys as $k){
            $val = $this->check($k, $data);
            if (null !== $val) $this->apiParams[$k] = $val;
        }
    }


}