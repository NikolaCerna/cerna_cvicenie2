<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    // GET /api/categories
    public function index()
    {
        $categories = Category::query()
            ->orderByDesc('updated_at')
            ->get();

        return response()->json(['categories'=>$categories], Response::HTTP_OK);
    }

    // GET /api/categories/{id}
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Kategória nenájdená.'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(['category'=>$category], Response::HTTP_OK);
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);
        return response()->json([
            'message' => 'Kategória bola úspešne vytvorená',
            'category' => $category,
        ], Response::HTTP_CREATED);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Kategória nenájdená.'], Response::HTTP_NOT_FOUND);
        }

        $category->update([
            'name'=>$request->name,
            'color'=>$request->color,
        ]);
        return response()->json(['category'=>$category], Response::HTTP_OK);
    }

    // DELETE /api/categories/{id}
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Kategória nenájdená.'], Response::HTTP_NOT_FOUND);
        }

        $category->delete();

        return response()->json(['message'=>'Kategória bola úspešne odstránená.'], Response::HTTP_OK);
    }
}
