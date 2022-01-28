<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class RequestController extends Controller
{
    public function createForm()
    {
        return view('admin.requests.add');
    }

    public function create(Request $request)
    {
        $this->valid($request);
        try {
            $fb = new \App\Models\Request();
            $fb->user_id = Auth::user()->id;
            $fb->name = $request->get('name');
            $fb->email = $request->get('email');
            $fb->phone = $request->get('phone');
            $fb->message = $request->get('message');
            $fb->save();
            return redirect()->back()->with('message', 'Request has been send successfully!');
        }
        catch (\Exception $ex)
        {
            return redirect()->back()->withErrors(['msg' => $ex]);
        }
    }

    public function updateForm(Request $request, $id)
    {
        $fb = \App\Models\Request::findOrFail($id);
        $viewDependencies = [
            'req' => $fb
        ];
        return view('admin.requests.edit', $viewDependencies);
    }

    public function update(Request $request)
    {
        var_dump($request->get('req_id'));
        $this->valid($request);
        try{
            $fb = \App\Models\Request::findOrFail($request->get('req_id'));
            $fb->name = $request->get('name');
            $fb->email = $request->get('email');
            $fb->phone = $request->get('phone');
            $fb->message = $request->get('message');
            $fb->save();
            return redirect()->back()->with('message', 'Request has been updated successfully!');
        }
        catch (\Exception $ex)
        {
            return redirect()->back()->withErrors(['msg' => $ex]);
        }
    }

    public function delete($id)
    {
        try {
            \App\Models\Request::findOrFail($id)->delete();
            return redirect()->back()->with('message', 'Request has been deleted successfully!');
        }
        catch (\Exception $ex)
        {
            return redirect()->back()->withErrors(['msg' => $ex]);
        }
    }

    private function valid($req)
    {
        return $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/', 'min:9']
        ]);
    }
}
