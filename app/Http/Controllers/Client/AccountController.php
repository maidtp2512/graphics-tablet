<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index($id){
        $user = User::find($id);
        $categories = new Category();
        $data = $categories->all(array('name', 'id'));
        return view('/client/account/profile', [
            'categories' => $data,
            'user'=>$user
        ]);
    }
    public function edit($id){
        $user = User::find($id);
        $categories = new Category();
        $data = $categories->all(array('name', 'id'));
        return view('/client/account/update', [
            'categories' => $data,
            'user'=>$user
        ]);
    }
    public function change($id){
        $user = User::find($id);
        $categories = new Category();
        $data = $categories->all(array('name', 'id'));
        return view('/client/account/change', [
            'categories' => $data,
            'user'=>$user,
            'id'=>$id
        ]);
    }
    public function changePass(Request $request, $id){
        $new_pass = $request->input('new_pass');
        $user = User::find($id);
        $user->password = Hash::make($new_pass);
        $user->save();
        $categories = new Category();
        $data = $categories->all(array('name', 'id'));
        return view('/client/account/change', [
            'categories' => $data,
            'user'=>$user,
            'id'=>$id,
            'message'=>'Đổi mật khẩu thành công!'
        ]);
    }
    public function updateProfile(Request $request, $id){
        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $user = User::find($id);
        $user->name = $name;
        $user->phone = $phone;
        $user->address = $address;
        $user->save();
        $categories = new Category();
        $data = $categories->all(array('name', 'id'));
        return view('/client/account/update', [
            'categories' => $data,
            'user'=>$user,
            'id'=>$id,
            'message'=>'Cập nhật tài khoản thành công!'
        ]);
    }
}
