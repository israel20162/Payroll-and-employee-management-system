<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'tasks']);
        $role->syncPermissions($request->input('permissions', []));

        return back()->with('success', 'Role created successfully.');
    }

    /**
     * assigns a user a new role
     *
     *
     *
     */
    public static function assignRole(int $employee_id, int $role_id)
    {
        $employee_has_role = DB::table('employee_role')->where('role_id', $role_id)->where('employee_id', $employee_id)->exists();

        if (!$employee_has_role) {
            DB::table('employee_role')->insert(['employee_id' => $employee_id, 'role_id' => $role_id, 'created_at' => date('Y-m-d H:m:s')]);
        } else {
            return false;
        }




    }
}
