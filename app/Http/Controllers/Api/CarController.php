<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Http\Resources\PricePackageResource;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Get all active cars with their price packages
     */
    public function index()
    {
        $cars = Car::active()
            ->with(['activePricePackages'])
            ->ordered()
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Cars retrieved successfully',
            'data' => CarResource::collection($cars)
        ]);
    }

    /**
     * Get car details with all price packages
     */
    public function show($id)
    {
        $car = Car::active()
            ->with(['pricePackages'])
            ->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Car details retrieved successfully',
            'data' => new CarResource($car)
        ]);
    }

    /**
     * Get cars with specific filters
     */
    public function search(Request $request)
    {
        $query = Car::active()->with(['activePricePackages']);

        // Filter by transmission
        if ($request->has('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Filter by minimum seats
        if ($request->has('min_seats')) {
            $query->where('seats', '>=', $request->min_seats);
        }

        // Filter by minimum bags
        if ($request->has('min_bags')) {
            $query->where('bags', '>=', $request->min_bags);
        }

        // Filter by price range
        if ($request->has('max_price')) {
            $query->whereHas('activePricePackages', function($q) use ($request) {
                $q->where('price', '<=', $request->max_price);
            });
        }

        $cars = $query->ordered()->get();

        return response()->json([
            'status' => true,
            'message' => 'Filtered cars retrieved successfully',
            'data' => CarResource::collection($cars)
        ]);
    }
}
