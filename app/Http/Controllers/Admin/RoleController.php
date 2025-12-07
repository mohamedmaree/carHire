<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\Roles;
use App\Traits\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\Create;

class RoleController extends Controller
{
    use Roles;

    public function __construct()
    {
        $name = 'role' ;
        $this->middleware('permission:read-all-' . $name)->only([ 'index' ]);
        $this->middleware('permission:read-' . $name)->only([ 'show' ]);
        $this->middleware('permission:create-' . $name)->only([ 'create', 'store' ]);
        $this->middleware('permission:update-' . $name)->only([ 'edit', 'update' ]);
        $this->middleware('permission:delete-' . $name)->only([ 'destroy' ]);
    }
    public function index()
    {
        if (request()->ajax()) {
            $roles = Role::search(request()->searchArray)->paginate(30);
            $html = view('admin.roles.table', compact('roles'))->render();
            return response()->json([ 'html' => $html ]);
        }
        return view('admin.roles.index');
    }

    public function create()
    {
        $permissions = Permission::all();
        $permissions = collect($permissions)->groupBy('model')->toArray();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Create $request)
    {
        $role = Role::create($request->validated());
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
        Report::addToLog('  اضافه صلاحية');
        return redirect(route('admin.roles.index'))->with('success', __('admin.added_successfully'));
    }

    /***************************  get all roles  **************************/
    public function edit($id)
    {
        $row = Role::findOrFail($id);
        $permissions = Permission::all();
        $permissions = collect($permissions)->groupBy('model')->toArray();

        return view('admin.roles.edit', compact('row', 'permissions'));
    }

    public function update(Create $request, $id)
    {
        if (!$request->permissions) {
            return back()->with('danger', __('admin.at_least_one_permission_required'));
        }
        $role = Role::findOrFail($id);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
        $role = $role->update($request->validated());
        Report::addToLog('  تعديل صلاحية');

        return redirect(route('admin.roles.index'))->with('success', __('admin.updated_successfully'));
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id)->delete();
        Report::addToLog('  حذف صلاحية');
        return response()->json([ 'id' => $id ]);
    }
}
