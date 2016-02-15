<?php
namespace app\controllers;
class ControllerFactory{
    static $instance;
    private function __construct(){

    }
    private function __clone(){

    }
    private function  __wakeup(){

    }
    public static function getInstance(){
        if(empty(self::$instance)){
            self::$instance=new Singleton();
        }
        return self::$instance;

    }
    public static function create($controllerName){
        if(empty(self::$instance)){
            $use='app\controllers\ ';
            $use=trim($use);
            $controller=$use.$controllerName;
            //$controllerFile=str_replace(trim('\ ')).'.php';
            if(!file_exists('app/controllers/'.$controllerName.'.php')){
                die('"'.$controllerName.'" Controller not found');
                return false;
            }
            self::$instance=new $controller();
        }
        return self::$instance;
    }
}