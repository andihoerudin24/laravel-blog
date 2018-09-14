<?php

namespace App\Http\Controllers;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
         $this->middleware('role:admin');
    }

    public function index()
    {
        $settings=Setting::first();
        return view('admin.settings.index',compact('settings'));
    }

    public function store(Request $request)
    {
       $this->validate($request,[
           'title'    => 'required',
           'email'    => 'required|email',
           'tagline'  => 'required',
           'phone'    => 'required',
           'address'   => 'required'
       ]);
       Setting::UpdateOrCreate([
            'id'=>1,
       ],$request->all());
       return redirect()->route('admin.settings.index');
    }
}
