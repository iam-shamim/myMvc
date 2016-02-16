<?php
 function view($viewFile,$data=null,$optional=null){
     if(func_num_args()===3){
         $$data=$optional;
         $data=null;
     }
     if(file_exists('app/views/'.$viewFile.'.blade.php')){
         include 'app/views/'.$viewFile.'.blade.php';
     }else{
         include 'app/views/'.$viewFile.'.php';
     }
}

function inc($layoutName,$data=null){
    if(file_exists('app/views/'.$layoutName.'.php')){
        if($data!==null AND is_array($data)){
            extract($data);
        }
        require 'app/views/'.$layoutName.'.php';
    }else{
        print_r(debug_backtrace());
    }
}

function mRoute($routeNamed,array $option=null){
    $routeNamedList=\app\myClass\Route::$routeNamed;
    if(!isset($routeNamedList[$routeNamed])){
        die('Route ['.$routeNamed.'] not defined. ');
    }
    $routeNamedVal=$routeNamedList[$routeNamed];
    preg_match_all('/{\w+}/',$routeNamedVal,$routeOptionArray);
    if(!empty($routeOptionArray[0])){
        $routeOption=count($routeOptionArray[0]);
        $takeOption=count($option);
        if($routeOption>$takeOption){
            die('Missing required parameters for [Route: '.$routeNamed.'] [URI: '.$routeNamedVal.'].');
        }
        $routeNamedValExp=explode('/',$routeNamedVal);
        $sl=0;
        array_walk($routeNamedValExp,function(&$val) use(&$option,&$sl){

            if(preg_match('/^{\w+}$/',$val)){
                $createVar=trim($val,'{}');
                if(isset($option[$createVar])){
                    $setVal=$option[$createVar];
                }else{
                    $setVal=current($option);
                }
                next($option);
                $val=$setVal;

            }
        });
        return implode('/',$routeNamedValExp);
    }

}
function route($routeNamed,array $option=null){
    return url(mRoute($routeNamed,$option));

}
function route_e($routeNamed,array $option=null){
    echo url(mRoute($routeNamed,$option));
}


function fileLinkCreate($link){
    echo URL.'/public/'.$link;
}
function url($url){
    return URL.'/'.$url;
}
function url_e($url){
    echo URL.'/'.$url;
}