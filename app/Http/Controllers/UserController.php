<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'name'     =>  'required',
            'email' =>  'required|email|unique:users,email,' . $user->id,
            'date'     =>  'required',
            'time'     =>  'required',
            'image'     =>  'required',

        ]);

        $data = DB::table('users')->insert([
            'name'      => $request->name,
            'email'             => $request->email,
            'date'             => $request->date,
            'time'             => $request->time,

        ]);
        $Userid = DB::getPdo()->lastInsertId();

        $documents = $request->allFiles()["image"];
        foreach ($documents as $key => $file) {
            $path = public_path() . '/images/store';

            $imageName = date('dmyhis') . 'image.' . $file->getClientOriginalExtension();
            //dd( $imageName);
            $file->move($path, $imageName);
            $data = DB::table('user_photos')->insert([
                'user_id'      => $Userid,
                'image'             => url('/public') . '/images/document/' . $imageName,

            ]);
        }
        return redirect()->back()->with("success", "Data successfully Inserted.");
    }
}
