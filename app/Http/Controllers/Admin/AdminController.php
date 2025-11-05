<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use App\Traits\Report;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Notifications\BlockUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\Create;
use App\Http\Requests\Admin\Admin\Update;
use Illuminate\Support\Facades\Notification;
use App\Models\Country;
use App\Models\SiteSetting;

class AdminController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        $name = 'admin';
        $this->middleware('permission:read-all-' . $name)->only([ 'index' ]);
        $this->middleware('permission:read-' . $name)->only([ 'show' ]);
        $this->middleware('permission:create-' . $name)->only([ 'create', 'store' ]);
        $this->middleware('permission:update-' . $name)->only([ 'edit', 'update' ]);
        $this->middleware('permission:delete-' . $name)->only([ 'destroy' ]);
        $this->middleware('permission:read-all-notification')->only(['notifications']);
    }

    public function index($id = null)
    {
        if (request()->ajax()) {
            $admins = Admin::search(request()->searchArray)->paginate(30);
            $html = view('admin.admins.table', compact('admins'))->render();
            return response()->json([ 'html' => $html ]);
        }
        return view('admin.admins.index');
    }

    public function create()
    {
        $roles = Role::latest()->get();
        $supported_countries = SiteSetting::where('key', 'countries')->first()->value ?? '';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id', $supported_countries)->orderBy('id', 'ASC')->get();
        return view('admin.admins.create', get_defined_vars());
    }

    public function store(Create $request)
    {
        $data = $request->validated();
        $is_blocked = ($request->is_blocked) ? 1 : 0;
        $data['is_blocked'] = $is_blocked;
        unset($data['role_id']);
        $admin = Admin::create($data);
        $role = Role::findOrFail($request->role_id);
        $admin->assignRole($role);
        Report::addToLog('  اضافه مدير');
        return response()->json([ 'url' => route('admin.admins.index') ]);
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::latest()->get();
        $supported_countries = SiteSetting::where('key', 'countries')->first()->value ?? '';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id', $supported_countries)->orderBy('id', 'ASC')->get();
        return view('admin.admins.edit', get_defined_vars());
    }

    public function update($id, Update $request)
    {
        $data = $request->validated();
        $admin = Admin::findOrFail($id);
        $is_blocked = ($request->is_blocked) ? 1 : 0;
        $data['is_blocked'] = $is_blocked;
        unset($data['role_id']);
        $admin->update($data);
        $role = Role::findOrFail($request->role_id);
        $admin->syncRoles($role);
        Report::addToLog('  تعديل مدير');
        return response()->json([ 'url' => route('admin.admins.index') ]);
    }

    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::latest()->get();
        $supported_countries = SiteSetting::where('key', 'countries')->first()->value ?? '';
        $supported_countries = json_decode($supported_countries);
        $countries = Country::whereIn('id', $supported_countries)->orderBy('id', 'ASC')->get();
        return view('admin.admins.show', get_defined_vars());
    }

    public function destroy($id)
    {
        if (1 == $id) {
            return;
        }

        Admin::findOrFail($id)->delete();
        Report::addToLog('  حذف مدير');
        return response()->json([ 'id' => $id ]);

    }

    public function destroyAll(Request $request)
    {
        $requestIds = array_column(json_decode($request->data), 'id');
        Admin::whereIntegerInRaw('id', $requestIds)->where('id', '!=', 1)->get()->each->delete();
        Report::addToLog('  حذف العديد من المديرين');
        return response()->json('success');
        //return response()->json('failed');
    }

    public function notifications()
    {
        auth('admin')->user()->unreadNotifications->markAsRead();
        return view('admin.admins.notifications');
    }

    public function deleteNotifications(Request $request)
    {
        $requestIds = array_column(json_decode($request->data), 'id');
        auth('admin')->user()->notifications()->whereIn('id', $requestIds)->delete();
        return $this->successMsg();
    }


    public function block(Request $request)
    {
        $admin = Admin::findOrFail($request->id);
        $admin->update([ 'is_blocked' => !$admin->is_blocked ]);
        Notification::send($admin, new BlockUser($request->all()));
        return response()->json([ 'message' => $admin->refresh()->is_blocked == 1 ? __('admin.client_blocked') : __('admin.client_unblocked') ]);
    }


    public function toggleBoolean($model, $id, $action)
    {
        $model = app("App\Models\\$model");
        $record = $model->findOrFail($id);
        toggleBoolean($record, $action);
        return $this->successMsg(__('admin.update_successfullay'));
    }
}
