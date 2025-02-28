<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        // dd($request);
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
}
