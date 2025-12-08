<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerOpinionResource;
use App\Models\CustomerOpinion;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CustomerOpinionController extends Controller
{
    use ResponseTrait;

    /**
     * Get all active customer opinions
     */
    public function index()
    {
        $customerOpinions = CustomerOpinion::active()
            ->ordered()
            ->get();

        return $this->successData(CustomerOpinionResource::collection($customerOpinions));
    }

    /**
     * Get a specific customer opinion
     */
    public function show($id)
    {
        $customerOpinion = CustomerOpinion::active()
            ->findOrFail($id);

        return $this->successData(new CustomerOpinionResource($customerOpinion));
    }
}
