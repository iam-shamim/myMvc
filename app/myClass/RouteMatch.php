<?php
namespace app\myClass;
use app\controllers;
class RouteMatch{
    function  __construct(){
            self::match();
    }
    public static function matchStatus(){
        $ActionMethod=ActionMethod;
        if(isset(Route::routeList()->$ActionMethod)){
            $route=Route::routeList()->$ActionMethod;
        }else{
            $route=[''];
        }
        $cRouteArray=explode('/',cRoute);
        foreach($route as $routeKey=>$val){    // foreach 1 starts
            $routeKey=$routeKey;
            if(empty(trim(cRoute,'/')) AND $val==='defaultApplicationRouteHomePage'){
                $matchStatus=true;
                goto GoToMatchStatus;

            }
            $returnStatus=false;
            $routeValExp=explode('/',$val);
            if(count($routeValExp)===count($cRouteArray)){;
                $matchStatus=true;
                $sl=0;
                $methodValue=[];
                foreach($routeValExp as $childVal1){    // foreach 2 start
                    if(strpos($childVal1,'{')!==false AND strpos($childVal1,'}')!==false){
                        $methodValue[]=$cRouteArray[$sl];
                        $sl++;
                        continue;
                    }else{
                        if($childVal1!==$cRouteArray[$sl]){
                            $matchStatus=false;
                        }
                    }
                    $sl++;
                }       // foreach 2 end
                GoToMatchStatus:
                if($matchStatus){
                    $ActionMethod=ActionMethod;
                    $routeReturnVal=Route::routeParam()->$ActionMethod[$val];
                    if(is_scalar($routeReturnVal)){
                        $expReturnVal=explode('@',$routeReturnVal);
                        $controllerName=$expReturnVal[0];
                        $controller=\app\controllers\ControllerFactory::create($controllerName);
                        $method=$expReturnVal[1];
                        call_user_func_array([$controller,$method],$methodValue);
                    }else if(is_callable($routeReturnVal)){
                        if(!isset($methodValue)){
                            $methodValue=[];
                        }
                        echo call_user_func_array($routeReturnVal,$methodValue);
                        //echo $routeReturnVal();
                    }
                    $returnStatus=true;
                    goto GoToNext;
                }else{
                    $returnStatus=false;
                }
            }
        } // foreach 1 end
        GoToNext:
        if($returnStatus){
                $routeValidationArr=(isset(route::$validation[$ActionMethod][$routeKey]))?route::$validation[$ActionMethod][$routeKey]:null;

            foreach($methodValue as $key=>$val){
                if(is_array($routeValidationArr)){
                    $current=current($routeValidationArr);
                    next($routeValidationArr);
                    $pattern='/'.$current.'/';
                    preg_match($pattern,$val,$matchedVal);
                    if(strlen($matchedVal[0])!==strlen($val)){
                        return false;
                    }
                }
            }
            return true;
        }else{
            return false;
        }
    }
    public static function match(){
        if(self::matchStatus()){
            //echo 'ok';
        }else{
            echo 'not match => '.cRoute;
            exit;
        }
    }
}