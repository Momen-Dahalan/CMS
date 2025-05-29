<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.all' , compact('permissions'));
    }


    public function store(Request $request){
       Role::find($request->role_id)->permissions()->sync($request->permission);
       return back()->with('success' , 'تم حفظ الصلاحيات الجديدة');
    }


    public function getPermissionsByRole(Request $request)
{
    $roleId = $request->id;
    $permissions = Role::find($roleId)->permissions->pluck('id'); // Assuming `permissions` is the relationship

    return response()->json($permissions);
}

}
