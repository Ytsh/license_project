<?php

namespace App\Http\Controllers;

use App\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('license.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $license = new License();

        $license->name = $request->name;
        $license->father_name = $request->father_name;
        $license->dob = $request->dob;
        $license->address = $request->address;
        $license->gender = $request->gender;
        $license->phone_number = $request->phone_number;

        //your_photo upload
        $myArray =explode('@', Auth::user()->email);
        $your_photo = 'your_photo_'.Auth::user()->id.'_'.time().'_'.$myArray[0].'.'.$request->your_photo->getClientOriginalExtension();
        $request->your_photo->move(public_path('/images/your_photos'), $your_photo);
        $license->your_photo = $your_photo;

        //citizenship_photo upload
        $citizenship_photo = 'citizenship_photo_'.Auth::user()->id.'_'.time().'_'.$myArray[0].'.'.$request->citizenship_photo->getClientOriginalExtension();
        $request->citizenship_photo->move(public_path('/images/citizenship_photos'), $citizenship_photo);
        $license->citizenship_photo = $citizenship_photo;

        $license->save();

        $user = User::find(Auth::user()->id);
        $user->is_registered = 1;
        $user->save();

        return redirect('/home')->withStatus('License Registered. Wait for Confirtmation.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        return view('license.edit', compact('license'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $license = License::find($id);

        $license->name = $request->name;
        $license->father_name = $request->father_name;
        $license->dob = $request->dob;
        $license->address = $request->address;
        $license->gender = $request->gender;
        $license->phone_number = $request->phone_number;

        //your_photo upload
        if($request->has('your_photo')){
            $myArray =explode('@', Auth::user()->email);
            $your_photo = 'your_photo_'.Auth::user()->id.'_'.time().'_'.$myArray[0].'.'.$request->your_photo->getClientOriginalExtension();
            $request->your_photo->move(public_path('/images/your_photos'), $your_photo);
            $license->your_photo = $your_photo;
        }

        //citizenship_photo upload
        if($request->has('citizenship_photo')){
            $citizenship_photo = 'citizenship_photo_'.Auth::user()->id.'_'.time().'_'.$myArray[0].'.'.$request->citizenship_photo->getClientOriginalExtension();
            $request->citizenship_photo->move(public_path('/images/citizenship_photos'), $citizenship_photo);
            $license->citizenship_photo = $citizenship_photo;
        }
        $license->save();

        return redirect('/home')->withStatus('License info updated. Wait for Confirtmation.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\License  $license
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        //
    }
}
