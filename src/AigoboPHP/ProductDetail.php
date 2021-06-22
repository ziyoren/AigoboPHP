<?php
/**
 * 7.5获取产品接口
 * 
 * 在线分销商通过产品号和计划编号获取产品基本信息。
 */

namespace ziyoren\AigoboPHP;

class ProductDetail extends ApiRequest
{
    protected $apiUrl = '/api/product/getDistrProductDetail';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述',]
        'productCode'  => [true, 'String', '200437","', '无', '产品编号',],
        'planCode'     => [false, 'String', 'GY66688', '无', '计划编号',],
        'memberId'     => [true, 'String', '88888888', '无', '会员号',],
    ];
}