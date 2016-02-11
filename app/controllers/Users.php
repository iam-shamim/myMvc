<?php
namespace app\controllers;
use app\controllers\Controller;
use app\models\user;

class Users extends Controller{
    public function show(){
        $data=user::all();
        return view('userDataShow','dataAll',$data);
    }
    public function editShow($id){
        return view('userEditForm',user::find($id));
    }
    public function addForm(){
        return view('userAddForm');
    }

}
