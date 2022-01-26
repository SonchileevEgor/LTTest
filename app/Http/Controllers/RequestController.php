<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function create($request)
    {
        $fb = new Request();
        $fb->user_id = Auth::user()->id;
        $fb->message = $request->get('message');
        $fb->save();
    }
    public function list()
    {
        $viewDependencies = [
            'listRequests' => Request::all()->get()
        ];
        return view('home', $viewDependencies);
    }

    public function update($request)
    {
        $fb = Request::findOrFail($request->id);
        $fb->user_id = Auth::user()->id;
        $fb->message = $request->get('message');
        $fb->save();
    }

    public function delete($id)
    {
        Request::findOrFail($id)->delete();
    }
}
