<?php

namespace App\Http\Controllers;
// use Illuminate\Http\Request;

use App\Models\Location;

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
        $locations = Location::all();
        return view('dashboard')->with([
            'locations' => $locations
        ]);
    }
}
