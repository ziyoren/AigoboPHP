<?php

namespace ziyoren\AigoboPHP;

class ApiRequest implements ApiInterface
{
    protected $apiUrl    = '';

    protected $apiParams = [];

    protected $allowParams = [
        'fieldNmae' => ['0是否必填', '1类型', '2参数示例', '3默认址', '4参数描述', '5错误代码']
    ];

    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    public function getParams()
    {
        return $this->apiParams;
    }

    public function getAllowParams()
    {
        return $this->allowParams;
    }

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
        foreach ($keys as $k){
            $val = $this->check($k, $data);
            if (null !== $val) $this->apiParams[$k] = $val;
        }
    }
    
    /**
     * 检查输入参数
     * @param string $key
     * @param array $data
     * @return mixed
     */
    protected function check($key, $data){
        $field = $this->allowParams[$key];
        $val = isset($data[$key]) ? $data[$key] : null;
        if ($field[0]){
            if (!empty( $val ) || 0 === $val || false === $val || '0' === $val) {
                return $val;
            } else{
                $code = isset($field[5]) ? $field[5] : 500;
                throw new \Exception( $field[4]. '(' .$key . ')为必填项。', $code);
            }
        }else{
            return $val;
        }
    }
}