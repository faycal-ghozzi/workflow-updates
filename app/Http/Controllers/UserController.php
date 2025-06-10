<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function add_agence(Request $request, $id){
        $agence = User::find($id);
        $old_agence = Agence::find($agence->agence_id)->designation;
        $agence->agence_id = $request['agence_id'];
        $agence->mail = $request['mail'];
        $agence->save();

        $auth_user = auth()->user()->name;
        $changed_user = $agence->name;
        $new_agence = Agence::find($request['agence_id'])->designation;

        // Log::channel('agence')->info("{$auth_user} changed {$changed_user} from old agency : {$old_agence} to new agency : {$new_agence}");

        return redirect()->back();
    }

    public function updateUserInfos(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $oldAgence = optional($user->agence)->designation;
        $user->agence_id = $request->input('agence_id');
        $user->mail = $request->input('mail');
        $newAgence = optional(Agence::find($request->input('agence_id')))->designation;

        $user->syncRoles($request->input('roles', []));
        $user->syncPermissions($request->input('permissions', []));

        $user->save();

        $authUser = auth()->user()->name;
        $changedUser = $user->name;

        // Log::channel('agence')->info("{$authUser} changed {$changedUser} from old agency: {$oldAgence} to new agency: {$newAgence}");

        $permissionsStr = '[' . implode(', ', (array) $request->input('permissions', [])) . ']';
        $rolesStr = '[' . implode(', ', (array) $request->input('roles', [])) . ']';

        // Log::channel('role')->info("{$authUser} set {$changedUser}'s roles to {$rolesStr}, permissions to {$permissionsStr}");

        return view('user.update-success', [
            'user' => $user,
            'message' => 'Modifications enregistrées avec succès.'
        ]);
    }

}