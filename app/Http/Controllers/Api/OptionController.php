<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Get all active options
     */
    public function index()
    {
        $options = Option::active()->ordered()->get();

        return response()->json([
            'status' => true,
            'message' => 'Options retrieved successfully',
            'data' => OptionResource::collection($options)
        ]);
    }

    /**
     * Get option details
     */
    public function show($id)
    {
        $option = Option::active()->findOrFail($id);

        return response()->json([
            'status' => true,
            'message' => 'Option details retrieved successfully',
            'data' => new OptionResource($option)
        ]);
    }

    /**
     * Get options by price type
     */
    public function byPriceType(Request $request)
    {
        $query = Option::active();

        if ($request->has('price_type')) {
            $query->where('price_type', $request->price_type);
        }

        $options = $query->ordered()->get();

        return response()->json([
            'status' => true,
            'message' => 'Options retrieved successfully',
            'data' => OptionResource::collection($options)
        ]);
    }
}
