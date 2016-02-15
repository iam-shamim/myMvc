<?php
namespace app\myClass;
use app\controllers;
use app\controllers\ControllerFactory;
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
            $methodValue=[];
            $optionToVal=[];
            $routeKey=$routeKey;
            if(empty(trim(cRoute,'/')) AND $val==='defaultApplicationRouteHomePage'){
                $matchStatus=true;
                goto GoToMatchStatus;
            }
            if(cRoute===$val){
                $matchStatus=true;
                goto GoToMatchStatus;
            }
            $returnStatus=false;
            $routeValExp=explode('/',$val);
            if(count($routeValExp)===count($cRouteArray)){
                $matchStatus=true;
                $sl=0;
                foreach($routeValExp as $childVal1){    // foreach 2 start
                    if(preg_match('/^{\w+}$/',$childVal1)){
                        $methodValue[]=$cRouteArray[$sl];
                        $optionToVal[$childVal1]=$cRouteArray[$sl]; // set value to optionToVal
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
                    $routeValidationArr=(isset(route::$validation[$ActionMethod][$routeKey]))?route::$validation[$ActionMethod][$routeKey]:[];
                    foreach($routeValidationArr as $validKey=>$validVal){
                        $textValidVal=$optionToVal['{'.$validKey.'}'];
                        $pattern='/'.$validVal.'/';
                        preg_match($pattern,$textValidVal,$matchedVal);
                        $matchedValFinal=(!isset($matchedVal[0]))? null: $matchedVal[0];
                        if(strlen($matchedValFinal)!==strlen($textValidVal)){
                            $returnStatus=false;
                            goto GoToNext;
                        }

                    }

                    if(is_scalar($routeReturnVal)){
                        $expReturnVal=explode('@',$routeReturnVal);
                        $controllerName=$expReturnVal[0];
                        $controller=ControllerFactory::create($controllerName);
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