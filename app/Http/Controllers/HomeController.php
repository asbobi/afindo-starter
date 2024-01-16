<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    private $menu = 'Dashboard';
    public function __construct()
    {
        View::share('menu', $this->menu);
        View::share('title', $this->menu);
        $this->middleware('auth');
    }

    
    public function index(Request $request)
    {
        if (Auth::check()) {
            return view('admin.home');
        }
    }
}
