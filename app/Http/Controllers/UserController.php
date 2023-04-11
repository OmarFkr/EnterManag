<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //$users = User::orderBy('id','desc')->paginate(5);

        $users = User::select('name', 'email')->get();

        /*return response()->json([
            'http response status codes' => '200',
            'users' => $users,
        ]);
        */

        return response()->json($users);
        
        //return view('users.index', compact('users'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('users.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        $user = User::create($request->post());

        return response()->json([
            'http response status codes' => '200',
            'user' => $user,
        ]);
        //return redirect()->route('users.index')->with('success','User has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function show(User $user)
    {
        return response()->json([
            'http response status codes' => '200',
            'user' => $user,
        ]);

        //return view('users.show',compact('user'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        $updatedUser = $user->fill($request->post())->save();

        return response()->json([
            'http response status codes' => '200',
            'updatedUser' => $updatedUser,
        ]);
        
        //return redirect()->route('users.index')->with('success','User Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\User  $user
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'http response status codes' => '200',
            'deletedUser' => $user,
        ]);

        //return redirect()->route('users.index')->with('success','User has been deleted successfully');
    }
}