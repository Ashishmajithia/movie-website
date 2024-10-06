<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
return view('frontend.index');
  }
    // Detail page function
    public function detail()
    {
        return view('frontend.detail');
    }
}
