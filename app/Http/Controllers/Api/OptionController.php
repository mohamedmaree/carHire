<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OptionResource;
use App\Models\Option;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    use ResponseTrait;

    /**
     * Get all active options
     */
    public function index()
    {
        $options = Option::active()->ordered()->get();

        return $this->successData(OptionResource::collection($options));
    }

    /**
     * Get option details
     */
    public function show($id)
    {
        $option = Option::active()->findOrFail($id);

        return $this->successData(new OptionResource($option));
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

        return $this->successData(OptionResource::collection($options));
    }
}
