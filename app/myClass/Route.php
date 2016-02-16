<?php
namespace app\myClass;
class Route{
    private static $routeList=[];
    public static $validation=[];
    private static $post=[];
    private static $put=[];
    private static $delete=[];
    private static $routeParam=[];
    private static $instance=null;
    private static $urlMethod;
    public static $routeNamed=[];

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
    static public function instanceCreate(){
        if(self::$instance===null){
            self::$instance=new self;
        }
        return self::$instance;
    }
    static public function get($url,$return){
        self::valid($return,$url);
        $url=trim($url,'/');
        self::urlEmptyCheck($url);

        self::$routeList['GET'][]=$url;

        if(is_array($return)){
            if(isset($return['as'])){self::$routeNamed[$return['as']]=$url;}
            if(isset($return[0])){
                if(is_callable($return[0])){
                    $return=$return[0];
                }
            }else if(isset($return['uses'])){
                $return=$return['uses'];
            }
        }
        self::$routeParam['GET'][$url]=$return;
        self::$urlMethod='GET';
        return self::instanceCreate();

    }
    // route validation
    public static function where($validator,$validation=null){
        if(is_array($validator)){
            $endVal=end(self::$routeList[self::$urlMethod]);
            self::$validation[self::$urlMethod][key(self::$routeList[self::$urlMethod])]=$validator;
        }else{
            $endVal=end(self::$routeList[self::$urlMethod]);
            self::$validation[self::$urlMethod][key(self::$routeList[self::$urlMethod])]=[$validator=>$validation];
        }

    }
    static public function post($url,$return){
        self::valid($return,$url);
        $url=trim($url,'/');
        self::urlEmptyCheck($url);

        self::$routeList['POST'][]=$url;
        if(is_array($return)){
            if(isset($return['as'])){self::$routeNamed[$return['as']]=$url;}
            if(isset($return[0])){
                if(is_callable($return[0])){
                    $return=$return[0];
                }
            }else if(isset($return['uses'])){
                $return=$return['uses'];
            }
        }
        self::$routeParam['POST'][$url]=$return;

        self::$urlMethod='POST';
        return self::instanceCreate();
    }
    static public function put($url,$return){
        self::valid($return,$url);
        $url=trim($url,'/');
        self::urlEmptyCheck($url);

        self::$routeList['PUT'][]=$url;
        if(is_array($return)){
            if(isset($return['as'])){self::$routeNamed[$return['as']]=$url;}
            if(isset($return[0])){
                if(is_callable($return[0])){
                    $return=$return[0];
                }
            }else if(isset($return['uses'])){
                $return=$return['uses'];
            }
        }
        self::$routeParam['PUT'][$url]=$return;

        self::$urlMethod='PUT';
        return self::instanceCreate();
    }
    static public function delete($url,$return){
        self::valid($return,$url);
        $url=trim($url,'/');
        self::urlEmptyCheck($url);

        self::$routeList['DELETE'][]=$url;
        if(is_array($return)){
            if(isset($return['as'])){self::$routeNamed[$return['as']]=$url;}
            if(isset($return[0])){
                if(is_callable($return[0])){
                    $return=$return[0];
                }
            }else if(isset($return['uses'])){
                $return=$return['uses'];
            }
        }
        self::$routeParam['DELETE'][$url]=$return;

        self::$urlMethod='DELETE';
        return self::instanceCreate();
    }

     // get list
    static public function routeList(){
        return (object) self::$routeList;
    }
    static public function routeParam(){
        return (object) self::$routeParam;
    }
}