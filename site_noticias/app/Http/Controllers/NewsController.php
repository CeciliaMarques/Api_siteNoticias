<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function addNews(Request $request)
    {
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

            $news = News::create([
                'author_name' => $fields['author_name'],
                'title' => $fields['title'],
                'caption' => $fields['caption'],
                'date' => $fields['date'],
                'text' => $fields['text'],
                'published_at' => $fields['published_at'],
                'status' => $fields['status'],
                'category_id'=> $fields['category_id'],
                'user_id'=> $fields['user_id']

            ]); {

                return response()->json([
                    'message' => ' News Registered Successfully.',
                    'news' => $news
                ], 201);
            }
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listNews()
    {
        try {
            $news = News::all();

            return response()->json([
                'message' => ' News.',
                'news' =>  $news
            ], 200);
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listNew($id)
    {
        try {
            $news = News::find($id);

            return response()->json([
                'message' => ' News.',
                'news' =>  $news
            ], 200);
        } catch (\Exception $e) {
            // Retornar erro genérico
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
