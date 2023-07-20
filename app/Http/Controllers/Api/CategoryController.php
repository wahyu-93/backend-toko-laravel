<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'success'    => true,
            'message'    => 'List Data Category',
            'categories' => $categories
        ], 200);
    }

    public function show($slug)
    {
        $categroy = Category::where('slug', $slug)->first();
        if ($categroy) {
            return response()->json([
                'success'   => true,
                'message'   => 'Lsy Product By Categroy : ' . $categroy->name,
                'product'   => $categroy->products()->latest()->get()
            ], 200);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Data Product By Category Tidak Ditemukan'
            ], 404);
        }
    }

    public function categoryHeader()
    {
        $categories = Category::latest()->take(5)->get();
        return response()->json([
            'success'    => true,
            'message'    => 'List Data Category Header',
            'categories' => $categories
        ], 200);
    }
}
