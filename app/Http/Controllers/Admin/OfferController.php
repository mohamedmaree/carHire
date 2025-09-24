<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Coupon;
use App\Http\Requests\Admin\offers\Store;
use App\Http\Requests\Admin\offers\Update;
use App\Traits\Report;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $name = 'offer';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            $offers = Offer::with('coupon')->search(request()->searchArray)->paginate(30);
            $html = view('admin.offers.table', compact('offers'))->render();
            return response()->json(['html' => $html]);
        }

        $couponsCollection = Coupon::where('status', 'available')->get();
        
        // Convert coupons collection to array format expected by the view
        $couponsArray = [];
        foreach ($couponsCollection as $coupon) {
            $couponsArray[] = [
                'name' => $coupon->coupon_num,
                'id' => $coupon->id,
            ];
        }

        return view('admin.offers.index', compact('couponsArray'));
    }

    public function create()
    {
        $coupons = Coupon::where('status', 'available')->get();
        return view('admin.offers.create', compact('coupons'));
    }

    public function store(Store $request)
    {
        Offer::create($request->validated());
        Report::addToLog('إضافة عرض جديد');
        return response()->json(['url' => route('admin.offers.index')]);
    }

    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $coupons = Coupon::where('status', 'available')->get();
        
        return view('admin.offers.edit', compact('offer', 'coupons'));
    }

    public function update(Update $request, $id)
    {
        $offer = Offer::findOrFail($id)->update($request->validated());
        Report::addToLog('تعديل عرض');
        return response()->json(['url' => route('admin.offers.index')]);
    }

    public function show($id)
    {
        $offer = Offer::with('coupon')->findOrFail($id);
        return view('admin.offers.show', compact('offer'));
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id)->delete();
        Report::addToLog('حذف عرض');
        return response()->json(['id' => $id]);
    }

    public function destroyAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (Offer::whereIntegerInRaw('id', $ids)->get()->each->delete()) {
            Report::addToLog('حذف العديد من العروض');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}