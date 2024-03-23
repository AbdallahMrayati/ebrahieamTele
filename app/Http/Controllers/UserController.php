<?php

namespace App\Http\Controllers;

use App\Models\PermissionType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        // $permissionTypes = Permission::all();
        return view('admin.users.users')->with(["users" => $users, "roles" => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:8|confirmed',
            'roleName' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new user instance
        $user = new User();

        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Assign a role to the user
        $roleName = $request->roleName; // Replace with the desired role name
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            $user->assignRole($role);

            // assign permissions direct
            if ($request->roleName === 'customer') {
                $user->syncPermissions([
                    'createCard',
                    'enableProxyFeatures',
                    'sendReqSeparateMobile',
                    'sendReqGasBalance',
                    'sendingDSL',
                ]);
            }
            if ($request->roleName === 'employee') {
                $user->syncPermissions([
                    'createCard',
                    'enableProxyFeatures',
                    'mangSer&PriceBalance',
                    'processReqSeparateMobile',
                    'processReqGasBalance',
                    'processingDSL',
                    'customerAccountStatement',
                    'websiteAdministration',
                ]);
            }


            return redirect()->route('users.index')->with('success', 'User created successfully');
        } else {
            return 'Role not found.';
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'username' => 'required',
            'name' => 'required',
            'roleName' => 'required',
        ]);

        // Update the user in the database
        $user = User::find($id);
        $user->username = $validatedData['username'];
        $user->name = $validatedData['name'];

        // Assign a role to the user
        $roleName = $request->roleName; // Replace with the desired role name
        $role = Role::where('name', $roleName)->first();

        if ($role) {
            // Remove existing roles
            $user->roles()->detach();

            // Assign the new role
            $user->assignRole($role);

            // assign permissions direct
            if ($request->roleName === 'customer') {
                $user->syncPermissions([
                    'createCard',
                    'enableProxyFeatures',
                    'sendReqSeparateMobile',
                    'sendReqGasBalance',
                    'sendingDSL',
                ]);
            }

            if ($request->roleName === 'employee') {
                $user->syncPermissions([
                    'createCard',
                    'enableProxyFeatures',
                    'mangSer&PriceBalance',
                    'processReqSeparateMobile',
                    'processReqGasBalance',
                    'processingDSL',
                    'customerAccountStatement',
                    'websiteAdministration',
                ]);
            }

            $user->save();

            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } else {
            return 'Role not found.';
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect the user or perform any additional actions

        return redirect()->back()->with('success', 'User deleted successfully');
    }


    public function resetPassword(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's password
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        // Redirect the user or perform any additional actions

        return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function updateUserState(Request $request, $id)
    {


        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's state
        $user->is_disabled = $request->has('user_disabled');
        $user->save();

        // Redirect the user or perform any additional actions

        return redirect()->back()->with('success', 'User state updated successfully');
    }

    public function permissionsUserPage($id)
    {

        // Retrieve the authenticated user
        $user = User::find($id);
        // return $user->permissions; // Check if the permissions are correctly loaded

        // Get the role names for the user
        $roleNames = $user->getRoleNames();
        // Assuming the user has only one role, you can get the first role name
        $role = $roleNames->first();

        // Retrieve the role model based on the role name
        $roleModel = Role::findByName($role);

        // Get the permissions for the role
        $permissions = $roleModel->permissions;
        // return $roleModel;

        // Loop through the permissions and extract the permissionType
        foreach ($permissions as $permission) {
            $permissionType = $permission->permissionType;
            $permissionTypes[] = $permissionType;
        }
        $uniquePermissionTypes = array_unique($permissionTypes);

        return view('admin.users.permissionsUser')->with(['user' => $user, 'permissions' => $permissions, 'permissionTypes' => $uniquePermissionTypes]);
    }

    public function changePermissions(Request $request, $userId)
    {
        $user = User::find($userId);

        // if ($user->hasPermissionTo('processReqSeparateMobile')) {
        //     return 'yes';
        // } else {
        //     return 'no';
        // }
        // return $user->permissions; // Check if the permissions are correctly loaded

        // Get the selected permission IDs from the form
        $selectedPermissions = $request->input('permissions', []);
        $permissionsToAssign = Permission::whereIn('id', $selectedPermissions)->get();


        // Sync the user's permissions
        $user->syncPermissions($permissionsToAssign);

        // Optionally, you can redirect back with a success message
        return redirect()->back()->with('success', 'Permissions updated successfully.');
    }
}
// $permissions = $user->getAllPermissions();
// foreach ($permissions as $permission) {
//     echo $permission->name . '<br>'; // or perform any other desired action with the permission
// }