<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'phone', 'regex:/(01)[0-9]{9}/'],
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reqs = \App\Models\Request::where('user_id', '=', Auth::user()->id)->get();
        if (Auth::user()->is_admin)
            $reqs = \App\Models\Request::all();

        $viewDependencies = [
            'listRequests' => $reqs
        ];
        return view('home', $viewDependencies);
    }
}
