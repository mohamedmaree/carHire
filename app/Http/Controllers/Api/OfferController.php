<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OfferCollection;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class OfferController extends Controller
{
    use ResponseTrait;
    public function index(Request $request)
    {
        $offers = Offer::activeByDate()
            ->ordered()
            ->with('coupon')
            ->paginate($this->paginateNum());
            
        return $this->successData(new OfferCollection($offers));
    }

    public function show($id)
    {
        $offer = Offer::activeByDate()
            ->with('coupon')
            ->findOrFail($id);
            
        return $this->successData(new OfferResource($offer));
    }

    public function latest(Request $request)
    {
        $limit = $request->get('limit', 5);
        
        $offers = Offer::activeByDate()
            ->ordered()
            ->with('coupon')
            ->take($limit)
            ->get();
            
        return $this->successData(OfferResource::collection($offers));
    }
}