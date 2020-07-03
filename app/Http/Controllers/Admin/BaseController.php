<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BaseController extends Controller
{
    public function change_locale($locale){
        session(['locale' => $locale]);
        return redirect()->back();
    }
}
