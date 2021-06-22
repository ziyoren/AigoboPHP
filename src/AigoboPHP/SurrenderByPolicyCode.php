<?php
/**
 * 7.9根据保单号退保
 * 
 * 根据保单号，多个保单号的话，以String数组形式包装参数进行退保
 */
namespace ziyoren\AigoboPHP;

class SurrenderByPolicyCode extends ApiRequest
{
    protected $apiUrl = '/api/policy/surrenderByPolicyCode';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'policyCodes'   => [true, 'String[]', 'String数组，多个保单号', '无', '保单号', 60510],
        'memberId'      => [true, 'String', '107084', '无', '会员号', 60511],
        'distrCode'     => [true, 'String', '', '无', '分销商编号', 60512],
    ];
}