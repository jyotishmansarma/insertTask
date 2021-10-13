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
        // $image = implode(',', $request->image);


        $data = DB::table('users')->insert([
            'name'      => $request->name,
            'email'             => $request->email,
            'date'             => $request->date,
            'time'             => $request->time,

        ]);
        $Userid = DB::getPdo()->lastInsertId();

        $documents = $request->allFiles()["image"];
        $array = [];
        foreach ($documents as $key => $file) {
            $path = public_path() . '/images/store';

            $imageName = date('dmyhis') . 'image.' . $file->getClientOriginalExtension();
            //dd( $imageName);
            $file->move($path, $imageName);
            $imageName = url('/public') . '/images/document/' . $imageName;

            array_push($array, $imageName);
        }
        $image = implode(', ', $array);
        DB::table('users')
            ->where('id', $Userid)
            ->update(array('image' => $image));
        return redirect()->back()->with("success", "Data successfully Inserted.");
    }
}
