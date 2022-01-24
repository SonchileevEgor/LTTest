<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create($request)
    {

    }
    public function list()
    {
        $viewDependencies = [
            'listRequests' => Request::all()->get()
        ];
        return view('home', $viewDependencies);
    }

//    public function save()
//    {
//
//    }

    public function update($request)
    {
        $req = Request::findOrFail($request->id);
    }

    public function delete($id)
    {
        Request::findOrFail($id)->delete();
    }
}
