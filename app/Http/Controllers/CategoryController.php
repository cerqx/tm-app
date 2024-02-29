<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->all());
        return response()->json(['message' => 'Categoria criada com sucesso', 'category' => $category], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(Category::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCategoryRequest $request, int $id): JsonResponse
    {
        $category = Category::where('id', $id)->first();
        $category->update($request->all());
        return response()->json($category, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json(Category::where('id', $id)->delete());
    }
}
