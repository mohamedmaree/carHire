<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $locations = Location::active()->ordered()->get();
        
        return $this->successData(LocationResource::collection($locations));
    }

    public function show($id)
    {
        $location = Location::active()->findOrFail($id);
        
        return $this->successData(new LocationResource($location));
    }

    public function byType(Request $request)
    {
        $query = Location::active();
        
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        
        $locations = $query->ordered()->get();
        
        return $this->successData(LocationResource::collection($locations));
    }

    public function airports()
    {
        $airports = Location::active()->airports()->ordered()->get();
        
        return $this->successData(LocationResource::collection($airports));
    }

    public function locations()
    {
        $locations = Location::active()->locations()->ordered()->get();
        
        return $this->successData(LocationResource::collection($locations));
    }

    public function nearby(Request $request)
    {
        $lat = $request->lat;
        $lng = $request->lng;
        $radius = $request->radius ?? 10; // Default 10km radius
        
        if (!$lat || !$lng) {
            return $this->failMsg(trans('apis.latitude_and_longitude_required'));
        }
        
        $locations = Location::active()
            ->selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lng) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance", [$lat, $lng, $lat])
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();
        
        return $this->successData(LocationResource::collection($locations));
    }
}
