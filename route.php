<?php
use app\myClass\Route;
Route::get('/about',function(){
    return 'Welcome about page.';
});
Route::get('/',function(){
    return 'Home Page';
});
Route::get('/user','Users@show');
Route::get('/about/{id}/you','About@You');
Route::get('posts/{post}/comments/{comment}','Users@show');
Route::get('/about/{id}/he',function(){
    return 'Hello.';
});
Route::get('user/edit/{id}','Users@editShow')->where('id','[0-9]+');
Route::get('user/userAdd','Users@addForm');
Route::delete('user/delete/{id}',function($id){
    echo $id;
})->where('id','[0-9]+');
Route::get('user/{id}/{name}', function($id, $name){
    return $id;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);