<?php

namespace ziyoren\AigoboPHP;

interface ApiInterface 
{
    public function getApiUrl();
    public function getAllowParams();
    public function setParams($key, $value=null);
    public function getParams();
}