<?php

namespace ziyoren\AigoboPHP;

use GuzzleHttp\Client as HttpClient;

class AgbApi
{
    protected $verion = '1.0';
    protected $_config;
    protected $_HOST;
    protected $_distr_code;
    protected $_employee_code;
    protected $_invitate_code;
    protected $_desKey;
    protected $_md5Key;
    protected $_accessToken;
    protected $log = null;
    protected $_ip = '';

    public function __construct($config = null, $logHandler=null)
    {
        $this->_config = $config;
        $this->checkConfig();
        $this->_HOST = $config['host'];
        $this->_distr_code = $config['distrCode'];
        $this->_employee_code = $config['employeeCode'];
        $this->_invitate_code = $config['invitateCode'];
        $this->_desKey = $config['desKey'];
        $this->_md5Key = $config['md5Key'];
        $this->_accessToken = $config['accessToken'];
        $this->log = $logHandler;
    }

    public function checkConfig()
    {
        $config = $this->_config;
        $keys = [
            ['host', 'API服务器地址', 40100],
            ['desKey', 'DES加密密钥', 40101],
            ['md5Key', 'MD5加密密钥', 40102],
            ['accessToken', '接口访问令牌', 40103],
            ['distrCode', '分销商编号', 40104],
            ['employeeCode', '销售人员推荐码', 40105],
            ['invitateCode', '分销商推荐码', 40106],
        ];
        foreach ($keys as $k){
            if (!isset($config[ $k[0] ])){
                throw new \Exception($k[1] . '('. $k[0] .')不能为空。', $k[2]);
            }
        }
    }

    public function setClientIp($ip)
    {
        $long = ip2long($ip);
        if (false !== $long && $long > -1) {
            $this->_ip = $ip;
        }
    }

    public function getClientIp()
    {
        return empty($this->_ip) ? '127.0.0.1' : $this->_ip;
    }

    public function getDistrCode()
    {
        return $this->_distr_code;
    }

    public function getEmployeeCode()
    {
        return $this->_employee_code;
    }

    public function getInvitateCode()
    {
        return $this->_invitate_code;
    }


    public final function request($apiRequest)
    {
        return $this->execute($apiRequest);
    }

    public final function execute($apiRequest)
    {
        $data        = $apiRequest->getParams();
        $nonce       = $this->generateNonce();
        $sign        = $this->generateSign($data);
        $requestBody = $this->getRequestBody($data);
        $params = [
            'accessToken' => $this->_accessToken,
            'ip'          => $this->getClientIp(),
            'nonce'       => $nonce,
            'requestBody' => $requestBody,
            'sign'        => $sign,
            'timestamp'   => $this->msectime(),
            'version'     => $this->verion,
        ];
        $client = new HttpClient();
        $apiUrl = $apiRequest->getApiUrl();
        $api_url = $this->_HOST. $apiUrl;
        $repuestParams = [
            'headers' => [
                'content-type' => 'application/json',
            ],
            'json' => $params,
        ];
        $res = $client->request('POST', $api_url, $repuestParams );
        $responstContent = $res->getBody()->getContents();
        $rst = json_decode( $responstContent, true );
        $result = $rst ? $rst : [ 'code'=>0, 'message' => '远程服务器响应报文转换失败。', 'rawBody' => $responstContent ];
        if ($this->log){
            $this->log->info($nonce . "\t" . $apiUrl, ['requestBody' => $data, 'params' => $params, 'result' => $result]);
        }
        return $result;
    }


    private function msectime() 
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }


    public function getRequestBody($params)
    {
        $jsonBody = json_encode($params, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        return base64_encode( $this->encrypt_des_ecb($jsonBody, $this->_desKey) );
    }


    private function generateNonce()
    {
        return self::create_uuid();
    }
 

    public static function create_uuid($prefix="")
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid = substr ( $chars, 0, 8 ) . '-'
            . substr ( $chars, 8, 4 ) . '-'
            . substr ( $chars, 12, 4 ) . '-'
            . substr ( $chars, 16, 4 ) . '-'
            . substr ( $chars, 20, 12 );
        return $prefix.$uuid ;
    }


    private function generateSign($params)
    {
        $ptxt = $this->build_plaintext($params);
        echo '加签明文：', $ptxt, PHP_EOL, PHP_EOL;
        $str = $ptxt . $this->_md5Key;
        return md5( md5( $str ) );
    }


    private function build_plaintext($params)
    {
        ksort($params); //keys排序
        $tmp = '';
        foreach ($params as $key => $val){
            if ( $val !== '' ){ //不要用empty，以免0值的影响
                if ( is_array($val) ){
                    if (empty($val)) continue;
                    //很难受的数据组织方式！！！水平有限，只能硬编码写死字段，特殊处理了。
                    switch ($key) {
                        case 'holderInfo':
                            $val = $this->getKeyEqValue($val); //这是键值对一维数组的处理方法
                            break;
                        case 'insuredInfoList':
                            $val = $this->queerJson($val);  //这是二维数组处理方法
                            break;
                        default:
                            $val = $this->getKeyEqValue($val); //默认以一维数组的方式处理
                    }
                }
                $tmp .= '&'. $key . '=' . $val;
            }
        }
        return mb_convert_case( ltrim($tmp, '&'), MB_CASE_UPPER, 'UTF-8' );
    }


    private function getKeyEqValue($data) 
    {
        $tmp = '';
        foreach ( $data as  $key => $val ){
            $tmp .= $key . '=' . $val . ', ';
        }
        return '{' . substr($tmp, 0, strlen($tmp)-2 ) . '}';
    }


    private function queerJson($data)
    {
        $tmp = '';
        foreach ($data as $d){
            $tmp .= $this->getKeyEqValue($d) . ', ';
        }
        return '[' . substr($tmp, 0, strlen($tmp)-2 ) . ']';
    }


    private function array2keyEqValue($data) 
    {
        $tmp = '';
        foreach ( $data as  $key => $val ){
            if (is_array($val)){
                $str = $this->array2keyEqValue($val);
            }else{
                $str = $val;
            }
            $tmp .= $key . '=' . $str . ', ';
        }
        return rtrim(', ', $tmp);
    }
    
    
    private function listKsort(&$data)
    {
        ksort( $data );
        foreach ($data as $k => &$v ){
            if (is_array($v)){
                $this->listKsort($v);
            }
        }
    }


    private function encrypt_des_ecb($plaintext, $key)
    {
        return openssl_encrypt($plaintext, 'des-ecb', $key, OPENSSL_RAW_DATA);
    }


    private function decrypt_des_ecb($ciphertext, $password)
    {
        return openssl_decrypt($ciphertext, 'des-ecb', $password, OPENSSL_RAW_DATA);
    }

}