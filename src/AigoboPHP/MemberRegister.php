<?php
/**
 * 7.1 注册渠道会员
 * 
 * 调取所有接口前，都必须注册渠道会员获取 memberId
 */

namespace ziyoren\AigoboPHP;

class MemberRegister extends ApiRequest
{
    protected $apiUrl = '/api/member/register';

    protected $allowParams = [
        // 'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
        'distrCode'    => [true, 'String', 'DL1000100', '无', '分销商编号(爱购保平台提供)', 60700],
        'employeeCode' => [true, 'String', 'GY66688', '无', '销售人员推荐码(爱购保平台提供)', 60701],
        'invitateCode' => [true, 'String', '88888888', '无', '分销商推荐码(爱购保平台提供)', 60702],
        'mobile'       => [true, 'String', '13600001111', '无', '会员手机号', 60703],
        'company'      => [true, 'String', '杭州智游网络科技有限公司', '无', '公司名称', 60704],
        'province'     => [true, 'String', '浙江省', '无', '省', 60705],
        'city'         => [true, 'String', '杭州市', '无', '市', 60706],
        'contact'      => [true, 'String', '习大大', '无', '公司联系人', 60707],
        'address'      => [true, 'String', '浙江省杭州市西湖区莫干山路', '无', '联系地址', 60708],
    ];
}