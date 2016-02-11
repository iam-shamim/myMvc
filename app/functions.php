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

function fileLinkCreate($link){
    echo URL.'/public/'.$link;
}