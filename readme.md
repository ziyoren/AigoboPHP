# 爱购保旅游保险平台API
爱购保为商户提供一整套，购买保险相关(投保、退保、开票、保单下载、第三方支付回调、订单查询)接口。商户使用这些接口可以便捷的发起投保请求并完成支付过程。支付分爱购保平台收银台支付(微信、支付宝)和分销商授信账户支付，投保并完成支付后，通过同步、异步两种方式通知分销商应用服务器。他的优势快捷方便的完成投保、退保、开票、保单下载等保险购买流程，用户在投保过程中简单、安全。同时爱购保又提供前端页面投保订单列表、订单详情、保单下载等操作。

## 安装
```sh
composer require ziyoren/aigobophp
```

## 接口目录
| 接口 | 接口地址 | 文件 |
|-----|----|----|
|7.1 注册渠道会员  | /api/member/register | MemberRegister.php |
|7.2 开票         | /api/order/applyInvoice| ApplyInvoice.php |
|7.3 获取发票地址  | /api/order/getInvoiceUrl| InvoiceUrl.php |
|7.4下预订单      | /api/order/addTemp | OrderTemp.php |
|7.5获取产品接口   | /api/product/getDistrProductDetail| ProductDetail.php |
|7.6 获取保单保地址| /api/policy/getPolicyUrl| PolicyUrl.php |
|7.7 第三方支付回调接口| /api/pay/outNotify | PayOutNotify.php |
|7.8 获取订单列表接口 | /api/order/getOrderListUrl| OrderListUrl.php |
|7.9根据保单号退保 | /api/policy/surrenderByPolicyCode | SurrenderByPolicyCode.php |
|7.10 根据订单号退保 | /api/policy/surrenderByOrderCode | SurrenderByOrderCode.php | 
|7.11 查询订单详情 | /api/order/getOrderDetail | OrderDetail.php | 

## 接口调用流程说明

1、首先注册分销商侧会员----7.1注册渠道会员；

2、分销商侧展示保险产品入口----7.5获取产品接口（根据产品编号可获取产品名称、产品计划、最低价格等信息）（产品编号向商务人员索取）；

3、分销商下用户点击保险产品入口，进入投保详情页并走后续支付流程；7.4下预定单（用户在爱购保收银台支付成功后，回调给分销商投保结果）

4、订单查询方式有两种：

①直接跳爱购保订单列表----7.8获取订单列表接口（爱购保提供该用户下的保单列表界面，可进行退保、开票操作）

②分销商自行做订单列表页----7.11查询订单详情；7.2开票；7.3获取发票地址；7.6获取保单地址

5、关于退保----7.9根据保单号退保/7.10根据订单号退保

## 测试用产品编号 
具体测试产品请联系商务人员

200437, 100371, 200161, 200104, 100434

## 几个回调通知的内容

### 退保：
```json
{
    "outSerialNo":"GP20218811000018",
    "orderCode":"10112107157115003105",
    "tempOrderCode":"10102107155232002102",
    "policyCode":"20210715152546",
    "success":true
}
```

### 投保：
```json
{
    "outSerialNo":"GP20218811000018",
    "tempOrderCode":"10102107155232002102",
    "orderCode":"10112107157115003105",
    "policyCode":"20210715152546",
    "success":true
}
```

