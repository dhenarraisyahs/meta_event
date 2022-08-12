<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
// use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $model)
    {
        $users = User::all();
        return view('users.index')->with([
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('users.add');
    }

    public function store(UserRequest $request)
    {
        $user = $request->all();
        
        User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit')->with([
            'user' => $user
        ]);
    }

    public function update(UserRequest $request, $id)
    {
        $user = $request->all();
        
        $user_item = User::findOrFail($id);
        $user_item->update($user);

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('user.index');
    }

    public function show($id)
    {
        //
    }
}
