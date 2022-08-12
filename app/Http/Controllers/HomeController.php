<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
    //  * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }
}