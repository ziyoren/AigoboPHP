<?php
$base_path = __DIR__;
$vender_path = dirname($base_path). '/vendor';
require_once $vender_path . '/autoload.php';


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$loger  = new Logger('example');
$streamHandler = new StreamHandler(dirname(__DIR__). '/logs/example-'. date('Y_m_d') .'.log', Logger::DEBUG);
$loger->pushHandler( $streamHandler );


function apiResponse($data)
{
    return json_encode($data, 256|128|JSON_UNESCAPED_SLASHES);
}