<?php

namespace App\Http\Resources;

use App\Http\Resources\OrderResource;
use App\Traits\PaginationTrait;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    use PaginationTrait;

    public function toArray($request)
    {
        return [
            'pagination' => $this->paginationModel($this),
            'data'       => OrderResource::collection($this->collection),
        ];
    }
}
