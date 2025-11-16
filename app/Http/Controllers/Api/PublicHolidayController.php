<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicHolidayResource;
use App\Models\PublicHoliday;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class PublicHolidayController extends Controller
{
    use ResponseTrait;

    /**
     * Get all active public holidays sorted by date
     */
    public function index(Request $request)
    {
        $query = PublicHoliday::active()->ordered();

        // Optional: Filter by year if provided
        if ($request->has('year')) {
            $query->byYear($request->year);
        }

        // Optional: Filter by date range
        if ($request->has('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->has('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        $publicHolidays = $query->get();
        return $this->successData(PublicHolidayResource::collection($publicHolidays));
    }

    /**
     * Get public holiday details
     */
    public function show($id)
    {
        $publicHoliday = PublicHoliday::active()->findOrFail($id);

        return $this->successData(new PublicHolidayResource($publicHoliday));
    }
}
