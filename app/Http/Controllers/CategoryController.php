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
    public function index()
    {
        return response()->json(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $data = [
          'name' => $request->name,
          'description' => $request->description,
        ];
        $category = Category::create($data);
        return response()->json(['message' => 'Categoria criada com sucesso', 'category' => $category], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(!is_numeric($id)) {
            return response()->json(['message'=>'O id deve ser um número'], 400);
        }
        return response()->json(Category::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCategoryRequest $request, $id)
    {
        if(!is_numeric($id)) {
            return response()->json(['message'=>'O id deve ser um número'], 400);
        }

        $category = Category::where('id', $id)->first();

        if(!$category) {
            return response()->json(['message'=>'A categoria não foi encontrada'], 400);
        }

        $data = [];

        foreach($request->all() as $key => $value) {
            $data[$key] = $value;
        }

       $category->update($data);

       return response()->json($category, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(!is_numeric($id)) {
            return response()->json(['message'=>'O id deve ser um número'], 400);
        }

        $category = Category::where('id', $id)->first();

        if(!$category) {
            return response()->json(['message'=>'A categoria não foi encontrada'], 400);
        }

        return response()->json($category->delete());
    }
}
