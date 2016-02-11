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
Route::post('/about/{id}/he',function(){
    return 'Hello.';
});
Route::get('userEdit/{id}','Users@editShow');
