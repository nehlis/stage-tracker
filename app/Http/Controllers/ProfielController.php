<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfielController extends Controller
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
        $user = Auth::user();

        return view('profiel', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'name'                 => ['sometimes', 'nullable', 'string', 'max:191'],
            'email'    => [
                'sometimes',
                'nullable',
                'string',
                'email',
                'max:191',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['sometimes', 'nullable', 'string', 'min:8', 'confirmed']
        ]);

        $user->name      = (isset($request->name) > 0) ? $request->name : $user->name;
        $user->email     = (isset($request->email) > 0) ? $request->email : $user->email;
        $user->password  = (isset($request->password) > 0) ? bcrypt(request('password')) : $user->password;

        $user->save();

        return back();
    }
}
