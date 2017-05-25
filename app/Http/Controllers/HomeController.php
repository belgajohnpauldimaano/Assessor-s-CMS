<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\pqa_assessors_info;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pqa_assessors_info = pqa_assessors_info::with(['educations', 'trainings', 'details'])->where('assessors_ID', Auth::user()->assessors_ID)->get();

        return view('home', ['pqa_assessors_info' => $pqa_assessors_info]);
    }
}
