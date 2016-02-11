<?php
session_start();
require_once 'app/define.php';
require_once 'config.php';
require_once 'app/functions.php';

function __autoload($className){
    $str='\ ';
    $str=trim($str);
    $classPath=str_replace($str,'/',$className);
    require_once $classPath.'.php';
}

require_once 'route.php';
use app\myClass\RouteMatch;
new RouteMatch();
