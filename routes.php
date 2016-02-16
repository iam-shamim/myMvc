<?php
use app\myClass\Route;
Route::get('/about',function(){
    return 'Welcome about page.';
});
Route::get('/',function(){
    return 'Home Page';
});

Route::get('/user',['as'=>'user','uses'=>'Users@show']);
Route::get('user/edit/{id}',['as'=>'userEdit','uses'=>'Users@editShow'])->where('id','[0-9]+');
Route::get('/about/{id}/you','About@you')->where('id','[0-9]+');
Route::get('posts/{post}/comments/{comment}','Users@show');
Route::get('/about/{id}/he',function(){
    return 'Hello.';
});

Route::get('user/userAdd','Users@addForm');
Route::get('user/delete/{id}',function($id){
    echo $id;
})->where('id','[0-9]+');
Route::get('user/{id}', function($id, $name){
    //return $id;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
Route::get('user/post/{id}/{comments_id}',['as'=>'userPost',function($id){
    return $id;
}])->where(['id'=>'[0-9]+']);

