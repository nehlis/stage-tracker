<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Submit from calendar.
     *
     * @param Request $request
     *
     * @return Request
     */
    public function trackTime(Request $request)
    {
        $timeTracked = new Time;

        $timeTracked->date = $request->inputDate;
        $timeTracked->begin = $request->inputBegin;
        $timeTracked->end = $request->inputEnd;
        $timeTracked->break = $request->inputBreak;
        $timeTracked->user_id = $request->user_id;

        $timeTracked->save();

        return $request;
    }
}
