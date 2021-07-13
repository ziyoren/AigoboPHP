<?php
$base_path = __DIR__;
$vender_path = dirname($base_path). '/vendor';
require_once $vender_path . '/autoload.php';

function apiResponse($data)
{
    return json_encode($data, 256|128|JSON_UNESCAPED_SLASHES);
}