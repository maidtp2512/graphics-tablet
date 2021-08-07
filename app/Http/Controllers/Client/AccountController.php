<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

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
            'user'=>$user
        ]);
    }
}
