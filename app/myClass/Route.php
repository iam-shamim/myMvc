<?php
namespace app\myClass;
class Route{
    private static $routeList=[];
    private static $post=[];
    private static $put=[];
    private static $delete=[];
    private static $routeParam=[];

    //route return validation
    static  public function valid($param,$url){
        if(is_scalar($param)){
            $expReturnVal=explode('@',$param);
            if(count($expReturnVal)<2){
                die("Route return parameter error. Route Name: \"<strong>{$url}</strong>\" return value: \"<strong>{$param}</strong>\".");
            }
        }
    }


    // set list
    static public function urlEmptyCheck(&$url){
        if(empty($url)){
            $url='defaultApplicationRouteHomePage';
        }
    }
    static public function get($url,$return){
        self::valid($return,$url);
        $url=trim($url,'/');
        self::urlEmptyCheck($url);
        self::$routeList['GET'][]=$url;
        self::$routeParam['GET'][$url]=$return;
    }
    static public function post($url,$return){
        self::valid($return,$url);
        $url=trim($url,'/');
        self::urlEmptyCheck($url);
        self::$routeList['POST'][]=$url;
        self::$routeParam['POST'][$url]=$return;
    }
    static public function put($url,$return){
        self::valid($return,$url);
        $url=trim($url,'/');
        self::urlEmptyCheck($url);
        self::$routeList['PUT'][]=$url;
        self::$routeParam['PUT'][$url]=$return;
    }
    static public function delete($url,$return){
        self::valid($return,$url);
        $url=trim($url,'/');
        self::urlEmptyCheck($url);
        self::$routeList['DELETE'][]=$url;
        self::$routeParam['DELETE'][$url]=$return;
    }

     // get list
    static public function routeList(){
        return (object) self::$routeList;
    }
    static public function routeParam(){
        return (object) self::$routeParam;
    }
}