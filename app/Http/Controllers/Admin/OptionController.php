<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\options\Store;
use App\Http\Requests\Admin\options\Update;
use App\Models\Option;
use App\Traits\Report;

class OptionController extends Controller
{
    public function __construct()
    {
        $name = 'option';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            $options = Option::search(request()->searchArray)->paginate(30);
            $html = view('admin.options.table', compact('options'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.options.index');
    }

    public function create()
    {
        return view('admin.options.create');
    }

    public function store(Store $request)
    {
        Option::create($request->validated());
        Report::addToLog('إضافة خيار جديد');
        return response()->json(['url' => route('admin.options.index')]);
    }

    public function edit($id)
    {
        $option = Option::findOrFail($id);
        return view('admin.options.edit', ['option' => $option]);
    }

    public function update(Update $request, $id)
    {
        $option = Option::findOrFail($id)->update($request->validated());
        Report::addToLog('تعديل خيار');
        return response()->json(['url' => route('admin.options.index')]);
    }

    public function show($id)
    {
        $option = Option::findOrFail($id);
        return view('admin.options.show', ['option' => $option]);
    }

    public function destroy($id)
    {
        $option = Option::findOrFail($id)->delete();
        Report::addToLog('حذف خيار');
        return response()->json(['id' => $id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Option::whereIntegerInRaw('id', $ids)->get()->each->delete()) {
            Report::addToLog('حذف العديد من الخيارات');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
