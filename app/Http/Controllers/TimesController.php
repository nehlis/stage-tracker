<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use App\User;

class TimesController extends Controller
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
     * Get all times for specific user.
     *
     * @param User $user
     *
     * @return Time
     */
    public function getTimes(User $user)
    {
        // TODO: De user mag alleen zijn eigen tijden ophalen. Op dit moment kan elke ingeloggde user de tijden van elke gebruiker opzoeken.
        $times = Time::where('user_id', $user->id)->get();

        return $times;
    }
}
