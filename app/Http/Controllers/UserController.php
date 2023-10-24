<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        SEO::title('All Users')
            ->description('Become the Splade expert!')
            ->keywords('laravel, splade, course');

        $users = Users::class;

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        SEO::title('Create User')
            ->description('Become the Splade expert!')
            ->keywords('laravel, splade, course');

        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'role' => ['required'],
            'password' => ['required'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // assign roled
        $user->assignRole($request->role);

        Toast::title('Yaaahh!')
            ->message('User created successfully')
            ->success()
            ->leftTop()
            ->backdrop()
            ->autoDismiss(15);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        SEO::title('Edit User:' . $user->name)
            ->description('Become the Splade expert!')
            ->keywords('laravel, splade, course');

        $roles = Role::all();

        return view('users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'role' => ['required'],
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->update($data);

        // assign roled
        $user->assignRole($request->role);

        Toast::title('Yaaahh!')
            ->message('User Updated successfully')
            ->success()
            ->leftTop()
            ->backdrop()
            ->autoDismiss(15);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
