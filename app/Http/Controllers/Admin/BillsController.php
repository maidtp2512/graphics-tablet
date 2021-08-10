<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    public function index(){
        $blogs = new Bill();
        $data = $blogs->all();
        return view('admin/bills/bills', ['bills' => $data]);
    }
    public function add(){
        return view('admin/bills/add');
    }
    public function detail(){
        return view('admin/bills/detail');
    }
    public function edit(){
        return view('admin/bills/edit');
    }
}
