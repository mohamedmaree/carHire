<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\locations\Store;
use App\Http\Requests\Admin\locations\Update;
use App\Models\Location;
use App\Traits\Report;

class LocationController extends Controller
{
    public function __construct()
    {
        $name = 'location';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            $locations = Location::search(request()->searchArray)->paginate(30);
            $html = view('admin.locations.table', compact('locations'))->render();
            return response()->json(['html' => $html]);
        }

        $locations = Location::search(request()->searchArray)->paginate(30);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Store $request)
    {
        Location::create($request->validated());
        Report::addToLog('إضافة موقع جديد');
        return response()->json(['url' => route('admin.locations.index')]);
    }

    public function edit($id)
    {
        $location = Location::findOrFail($id);
        return view('admin.locations.edit', ['location' => $location]);
    }

    public function update(Update $request, $id)
    {
        $location = Location::findOrFail($id)->update($request->validated());
        Report::addToLog('تعديل موقع');
        return response()->json(['url' => route('admin.locations.index')]);
    }

    public function show($id)
    {
        $location = Location::findOrFail($id);
        return view('admin.locations.show', ['location' => $location]);
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id)->delete();
        Report::addToLog('حذف موقع');
        return response()->json(['id' => $id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Location::whereIntegerInRaw('id', $ids)->get()->each->delete()) {
            Report::addToLog('حذف العديد من المواقع');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
