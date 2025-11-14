<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\public_holiday\Store;
use App\Http\Requests\Admin\public_holiday\Update;
use App\Models\PublicHoliday;
use App\Traits\Report;

class PublicHolidayController extends Controller
{
    public function __construct()
    {
        $name = 'public-holiday';
        $this->middleware('permission:read-all-' . $name)->only(['index']);
        $this->middleware('permission:read-' . $name)->only(['show']);
        $this->middleware('permission:create-' . $name)->only(['create', 'store']);
        $this->middleware('permission:update-' . $name)->only(['edit', 'update']);
        $this->middleware('permission:delete-' . $name)->only(['destroy']);
    }

    public function index()
    {
        if (request()->ajax()) {
            $publicHolidays = PublicHoliday::search(request()->searchArray)->paginate(30);
            $html = view('admin.public_holiday.table', compact('publicHolidays'))->render();
            return response()->json(['html' => $html]);
        }

        $publicHolidays = PublicHoliday::search(request()->searchArray)->paginate(30);
        return view('admin.public_holiday.index', compact('publicHolidays'));
    }

    public function create()
    {
        return view('admin.public_holiday.create');
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        
        // Extract year from date
        if (isset($data['date'])) {
            $data['year'] = \Carbon\Carbon::parse($data['date'])->year;
        }
        
        PublicHoliday::create($data);
        Report::addToLog('إضافة عطلة رسمية جديدة');
        return response()->json(['url' => route('admin.public-holidays.index')]);
    }

    public function edit($id)
    {
        $publicHoliday = PublicHoliday::findOrFail($id);
        return view('admin.public_holiday.edit', compact('publicHoliday'));
    }

    public function update(Update $request, $id)
    {
        $publicHoliday = PublicHoliday::findOrFail($id);
        $data = $request->validated();
        
        // Extract year from date if date is updated
        if (isset($data['date'])) {
            $data['year'] = \Carbon\Carbon::parse($data['date'])->year;
        }
        
        $publicHoliday->update($data);
        Report::addToLog('تعديل عطلة رسمية');
        return response()->json(['url' => route('admin.public-holidays.index')]);
    }

    public function show($id)
    {
        $publicHoliday = PublicHoliday::findOrFail($id);
        return view('admin.public_holiday.show', compact('publicHoliday'));
    }

    public function destroy($id)
    {
        PublicHoliday::findOrFail($id)->delete();
        Report::addToLog('حذف عطلة رسمية');
        return response()->json(['icon' => 'success', 'title' => __('admin.deleted_successfully')]);
    }

    public function destroyAll(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'required|exists:public_holidays,id',
        ]);
        PublicHoliday::whereIn('id', $request->ids)->delete();
        Report::addToLog('حذف مجموعة عطلات رسمية');
        return response()->json(['icon' => 'success', 'title' => __('admin.deleted_successfully')]);
    }
}
