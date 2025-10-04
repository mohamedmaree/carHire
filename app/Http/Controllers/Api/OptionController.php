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
     * Get all active options (root options only - standalone and parent options)
     */
    public function index()
    {
        $options = Option::active()
            ->rootOptions()
            ->with(['parent', 'children'])
            ->ordered()
            ->get();

        return $this->successData(OptionResource::collection($options));
    }

    /**
     * Get option details
     */
    public function show($id)
    {
        $option = Option::active()
            ->with(['parent', 'children'])
            ->findOrFail($id);

        return $this->successData(new OptionResource($option));
    }

    /**
     * Get options by price type (root options only)
     */
    public function byPriceType(Request $request)
    {
        $query = Option::active()->rootOptions()->with(['parent', 'children']);

        if ($request->has('price_type')) {
            $query->where('price_type', $request->price_type);
        }

        $options = $query->ordered()->get();

        return $this->successData(OptionResource::collection($options));
    }

    /**
     * Get parent options only
     */
    public function parents()
    {
        $options = Option::active()
            ->parents()
            ->with(['children'])
            ->ordered()
            ->get();

        return $this->successData(OptionResource::collection($options));
    }

    /**
     * Get child options for a specific parent
     */
    public function children($parentId)
    {
        $options = Option::active()
            ->where('parent_id', $parentId)
            ->ordered()
            ->get();

        return $this->successData(OptionResource::collection($options));
    }

    /**
     * Get all options including children (for admin or special use cases)
     */
    public function all()
    {
        $options = Option::active()
            ->with(['parent', 'children'])
            ->ordered()
            ->get();

        return $this->successData(OptionResource::collection($options));
    }
}
