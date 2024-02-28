<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
            $data = [
                'category_id'=> $request->category_id,
                'name'=> $request->name,
                'description'=> $request->description,
                'price'=> $request->price,
                'status'=> $request->status,
            ];
            $product = Product::create($data);
            return response()->json(['message' => 'Produto criado com sucesso', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(!is_numeric($id)) {
            return response()->json(['message'=>'O id deve ser um número'], 400);
        }

        return response()->json(Product::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, $id)
    {
        if(!is_numeric($id)) {
            return response()->json(['message'=>'O id deve ser um número'], 400);
        }

        $product = Product::where('id', $id)->first();

        if(!$product) {
            return response()->json(['message'=>'O produto não foi encontrado'], 400);
        }

        $data = [];

        foreach($request->all() as $key => $value) {
            $data[$key] = $value;
        }

        $product->update($data);

        return response()->json($product, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(!is_numeric($id)) {
            return response()->json(['message'=>'O id deve ser um número'], 400);
        }

        $product = Product::where('id', $id)->first();

        if(!$product) {
            return response()->json(['message'=>'O produto não foi encontrado'], 400);
        }

        return response()->json($product->delete());
    }
}
