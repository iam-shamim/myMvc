<?php
namespace app\controllers;
class ControllerFactory{
    public static function create($controllerName){
        $use='app\controllers\ ';
        $use=trim($use);
        $controller=$use.$controllerName;
        return new $controller;
    }
}