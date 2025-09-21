<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\price_packages\Store;
use App\Http\Requests\Admin\price_packages\Update;
use App\Models\PricePackage;
use App\Models\Car;
use App\Traits\Report;

class PricePackageController extends Controller
{
    public function __construct()
    {
        $name = 'price-package';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            $pricePackages = PricePackage::with('car')->search(request()->searchArray)->paginate(30);
            $html = view('admin.price_packages.table', compact('pricePackages'))->render();
            return response()->json(['html' => $html]);
        }

        return view('admin.price_packages.index');
    }

    public function create()
    {
        $cars = Car::active()->ordered()->get();
        return view('admin.price_packages.create', compact('cars'));
    }

    public function store(Store $request)
    {
        PricePackage::create($request->validated());
        Report::addToLog('إضافة باقة أسعار جديدة');
        return response()->json(['url' => route('admin.price-packages.index')]);
    }

    public function edit($id)
    {
        $pricePackage = PricePackage::findOrFail($id);
        $cars = Car::active()->ordered()->get();
        return view('admin.price_packages.edit', ['pricePackage' => $pricePackage, 'cars' => $cars]);
    }

    public function update(Update $request, $id)
    {
        $pricePackage = PricePackage::findOrFail($id)->update($request->validated());
        Report::addToLog('تعديل باقة أسعار');
        return response()->json(['url' => route('admin.price-packages.index')]);
    }

    public function show($id)
    {
        $pricePackage = PricePackage::with('car')->findOrFail($id);
        return view('admin.price_packages.show', ['pricePackage' => $pricePackage]);
    }

    public function destroy($id)
    {
        $pricePackage = PricePackage::findOrFail($id)->delete();
        Report::addToLog('حذف باقة أسعار');
        return response()->json(['id' => $id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (PricePackage::whereIntegerInRaw('id', $ids)->get()->each->delete()) {
            Report::addToLog('حذف العديد من باقات الأسعار');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
