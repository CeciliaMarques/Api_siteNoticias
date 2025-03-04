<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
        ]);

        try {

            $category = Category::create([
                'name' => $fields['name'],

            ]); {

                return response()->json([
                    'message' => ' Category Registered Successfully.',
                    'category' => $category
                ], 201);
            }
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json([
                'message' => 'Category not found',
            ], 404);
        }

        $fields = $request->validate([
            'name' => 'required|string'
        ]); 
        try {
            $category->update([
                'name' => $fields['name']
            ]);

            return response()->json([
                'message' => ' Category updated successfully.',
                'category' => $category

            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 

    public function listCategories()
    {
        try {
            $categories = Category::all();

            return response()->json([
                'message' => ' Categories.',
                'categories' => $categories
            ], 200);
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listCategory($id)
    {
        try {
            $category = Category::find($id);

            return response()->json([
                'message' => ' Category.',
                'category' =>  $category
            ], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Category not found',
            ], 404);
        }
        try {

            $category->delete();
            
            return response()->json([
                'message' => ' Category Deleted Successfully.',
            ], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
