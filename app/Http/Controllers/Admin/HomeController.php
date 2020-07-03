<?php

namespace App\Http\Controllers\Admin;

//use App\Http\Controllers\Controller;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;

class HomeController extends BaseController
{
    public function home(){
        return view('admin.home');
    }
}
