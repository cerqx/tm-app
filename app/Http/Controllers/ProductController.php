<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return ProductResource::collection(Product::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
            $product = Product::create($request->all());
            return response()->json(['message' => 'Produto criado com sucesso', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Product::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, int $id): JsonResponse
    {

        $product = Product::where('id', $id)->first();
        $product->update($request->all());
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return response()->json(Product::where('id', $id)->delete());
    }
}
