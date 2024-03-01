<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'category' => new CategoryResource($this->resource->category),
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'price' => 'R$'.number_format($this->resource->price, 2, ',', '.'),
            'status' => $this->resource->status,
        ];
    }
}
