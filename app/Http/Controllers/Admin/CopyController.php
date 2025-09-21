<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\folderName\Store;
use App\Http\Requests\Admin\folderName\Update;
use App\Models\M_odel ;
use App\Traits\Report;


class M_odelController extends Controller
{

    public function __construct()
    {
        $name = 'modelKebabCase';
        $this->middleware('permission:read-all-' . $name)->only([ 'index' ]);
        $this->middleware('permission:read-' . $name)->only([ 'show' ]);
        $this->middleware('permission:create-' . $name)->only([ 'create', 'store' ]);
        $this->middleware('permission:update-' . $name)->only([ 'edit', 'update' ]);
        $this->middleware('permission:delete-' . $name)->only([ 'destroy' ]);
    }

    public function index($id = null)
    {
        if (request()->ajax()) {
            $modelPluralSnakeCase = M_odel::search(request()->searchArray)->paginate(30);
            $html = view('admin.folderName.table' ,compact('modelPluralSnakeCase'))->render() ;
            return response()->json(['html' => $html]);
        }

        return view('admin.folderName.index');
    }

    public function create()
    {
        return view('admin.folderName.create');
    }


    public function store(Store $request)
    {
        M_odel::create($request->validated());
        Report::addToLog('  اضافه arSingleName') ;
        return response()->json(['url' => route('admin.modelKebabPluralName.index')]);
    }
    public function edit($id)
    {
        $modelSnakeCase = M_odel::findOrFail($id);
        return view('admin.folderName.edit' , ['modelSnakeCase' => $modelSnakeCase]);
    }

    public function update(Update $request, $id)
    {
        $modelSnakeCase = M_odel::findOrFail($id)->update($request->validated());
        Report::addToLog('  تعديل arSingleName') ;
        return response()->json(['url' => route('admin.modelKebabPluralName.index')]);
    }

    public function show($id)
    {
        $modelSnakeCase = M_odel::findOrFail($id);
        return view('admin.folderName.show' , ['modelSnakeCase' => $modelSnakeCase]);
    }
    public function destroy($id)
    {
        $modelSnakeCase = M_odel::findOrFail($id)->delete();
        Report::addToLog('  حذف arSingleName') ;
        return response()->json(['id' =>$id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (M_odel::whereIntegerInRaw('id',$ids)->get()->each->delete()) {
            Report::addToLog('  حذف العديد من arpluraleName') ;
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
