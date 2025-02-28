<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class NewsController extends Controller
{
    public function addNews(Request $request)
    {
        // dd($request);
        $fields = $request->validate([
            'author_name' => 'required|string',
            'title' => 'required|string',
            'caption' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'text' => 'required|string',       
            'published_at'=> 'required|date_format:Y-m-d',
            'status' =>'required|string',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer'
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
