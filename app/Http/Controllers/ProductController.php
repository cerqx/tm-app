<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(): ResourceCollection
    {
        return ProductResource::collection(Product::with('category')->paginate(10));
    }

    public function store(CreateProductRequest $request): ProductResource
    {
        return new ProductResource(Product::create($request->validated()));
    }

    public function show(int $id): JsonResource
    {
        return new ProductResource(Product::findOrFail($id));
    }

    public function update(EditProductRequest $request, int $id): ProductResource
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return new ProductResource($product);
    }

    public function destroy(int $id): Response
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->noContent();
    }
}
