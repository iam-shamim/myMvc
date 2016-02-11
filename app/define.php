<?php
define('ActionMethod',$_SERVER['REQUEST_METHOD']);
if(isset($_GET['cRoute'])){
    define('cRoute',trim($_GET['cRoute'],'/'));
}else{
    define('cRoute','/');
}

