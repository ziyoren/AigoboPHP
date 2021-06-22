<?php

namespace ziyoren\AigoboPHP;

use GuzzleHttp\Client as HttpClient;

class AgbApi
{
    protected $verion = '1.0';

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
            'ip'          => '127.0.0.1',
            'nonce'       => $nonce,
            'requestBody' => $requestBody,
            'sign'        => $sign,
            'timestamp'   => $this->msectime(),
            'version'     => $this->verion,
        ];
        echo '完整报文: ', json_encode($params, 256), PHP_EOL, PHP_EOL;
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
        echo '服务器响应报文：', json_encode($result, 256), PHP_EOL, PHP_EOL;
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
        echo 'jsonBody: ', $jsonBody, PHP_EOL, PHP_EOL;
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
        echo 'generateSign: ', $ptxt, PHP_EOL, PHP_EOL;
        $str = $ptxt . $this->_md5Key;
        return md5( md5( $str ) );
    }


    private function build_plaintext($params)
    {
        ksort($params); //keys排序
        $tmp = '';
        foreach ($params as $key => $val){
            if ( $val !== '' ){ //不要用empty，以免0值的影响
                if (is_array($val) || is_object($val)){
                    $val = json_encode($val, 256|JSON_FORCE_OBJECT);
                }
                $tmp .= '&'. $key . '=' . $val;
            }
        }
        return mb_convert_case( ltrim($tmp, '&'), MB_CASE_UPPER, 'UTF-8' );
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