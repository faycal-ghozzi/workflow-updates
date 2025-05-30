<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller{
    public function list(){
        $users = User::all();

        return view('user.list', compact('users'));
    }

    public function show($id){
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        $roles = Role::all();
        $agences = Agence::all();

        return view('user.show', compact('user', 'roles', 'permissions', 'agences'));
    }
}