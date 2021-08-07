<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillsController extends Controller
{
    public function index(){
        return view('admin/bills/bills');
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
