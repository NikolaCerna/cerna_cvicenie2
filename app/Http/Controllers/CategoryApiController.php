<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryApiController extends Controller
{
    // GET /api/categories
    public function index()
    {
        $categories = Category::query()
            ->select(['id', 'name', 'color', 'created_at', 'updated_at'])
            ->orderByDesc('updated_at')
            ->get();

        return response()->json([
            'categories' => $categories
        ], Response::HTTP_OK);
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:64', 'unique:categories,name'],
            'color' => ['required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $category = Category::create([
            'name' => $validated['name'],
            'color' => $validated['color'],
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
            return response()->json([
                'message' => 'Kategória nenájdená.'
            ], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'min:2', 'max:64',
                Rule::unique('categories', 'name')->ignore($category->id),],
            'color' => ['sometimes', 'required', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $category->update($validated);

        return response()->json([
            'message'  => 'Kategória bola aktualizovaná.',
            'category' => $category
        ], Response::HTTP_OK);
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
