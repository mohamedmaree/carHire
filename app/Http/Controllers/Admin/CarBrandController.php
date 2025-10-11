<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\car_brands\Store;
use App\Http\Requests\Admin\car_brands\Update;
use App\Models\CarBrand;
use App\Traits\Report;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    public function __construct()
    {
        $name = 'car-brand';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            $carBrands = CarBrand::search(request()->searchArray)->paginate(30);
            $html = view('admin.car_brands.table', compact('carBrands'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.car_brands.index');
    }

    public function create()
    {
        return view('admin.car_brands.create');
    }

    public function store(Store $request)
    {
        CarBrand::create($request->validated());
        Report::addToLog('إضافة علامة تجارية جديدة');
        return response()->json(['url' => route('admin.car_brands.index')]);
    }

    public function show($id)
    {
        $carBrand = CarBrand::findOrFail($id);
        return view('admin.car_brands.show', compact('carBrand'));
    }

    public function edit($id)
    {
        $carBrand = CarBrand::findOrFail($id);
        return view('admin.car_brands.edit', compact('carBrand'));
    }

    public function update(Update $request, $id)
    {
        CarBrand::findOrFail($id)->update($request->validated());
        Report::addToLog('تعديل علامة تجارية');
        return response()->json(['url' => route('admin.car_brands.index')]);
    }

    public function destroy($id)
    {
        $carBrand = CarBrand::findOrFail($id);
        $carBrand->delete();
        Report::addToLog('حذف علامة تجارية');
        return response()->json(['id' => $id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (CarBrand::whereIntegerInRaw('id', $ids)->get()->each->delete()) {
            Report::addToLog('حذف العديد من علامات تجارية');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

}
