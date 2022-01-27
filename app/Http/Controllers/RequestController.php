<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function create(Request $request)
    {
        $fb = new \App\Models\Request();
        $fb->user_id = Auth::user()->id;
        $fb->name = $request->get('name');
        $fb->email = $request->get('email');
        $fb->phone = $request->get('phone');
        $fb->message = $request->get('message');
        $fb->save();
        return redirect()->back()->with('message', 'Request has been send successfully!');
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
