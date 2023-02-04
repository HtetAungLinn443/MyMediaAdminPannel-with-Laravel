<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get All Category
    public function getAllCategory()
    {
        $data = Category::select('category_id', 'title', 'description')->get();
        return response()->json([
            'category' => $data,
        ]);
    }

    // Search Category
    public function categorySearch(Request $request)
    {
        $data = Category::select('posts.*')
            ->join('posts', 'categories.category_id', 'posts.category_id')
            ->where('categories.title', 'like', '%' . $request->key . '%')
            ->get();
        logger($data);
        return response()->json([
            'result' => $data,
        ]);
    }
}