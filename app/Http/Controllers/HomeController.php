<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;

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
        // $user = \Auth::user()->student->photo;
        // dd($user);
        // if($user->hasRole('admin')){
        //     return view('backend.home');
        // }
        return view('home');
    }

    public function showProfile()
    {
        return view('backend.profile.index');
    }

    public function editProfile()
    {
        return view('backend.profile.edit');
    }

    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profile = Student::findOrFail(\Auth::user()->student->id);


        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString()); 
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $data->image = $name;
            $file->move(public_path().'/images/', $name);  
        // dd($profile);
        }

        $profile->update([
            'birthday' => $request->birthday,
            'birthplace' => $request->birthplace,
            'address' => $request->address,
            'phone' => $request->phone,
            'photo' => $request->photo,
        ]);

        $profile->save();
        return redirect(route('profile.show'));
    }
}
