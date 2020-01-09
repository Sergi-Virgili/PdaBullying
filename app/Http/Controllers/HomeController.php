<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth')->except('iframe');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('spa');
    }
    public function publish()
    {
        return view('admin.publish');
    }
    public function iframe() {
        return view('iframe');  
    } 
}
