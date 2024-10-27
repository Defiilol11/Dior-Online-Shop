<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GetCategories extends Controller
{
    public function index()
    {
        $categories = Category::all(['id', 'name']);
        return view('Categories', compact('categories'));
    }

    public function beauty()
    {
        $category = Category::where('id', 1)->first();
        if (!$category) {
            return redirect()->back()->withErrors('Categoría no encontrada');
        }

        $products = Product::where('category_id', $category->id)->get();
        return view('beauty', compact('category', 'products'));
    }

    public function fashion()
    {
        $category = Category::where('id', 2)->first();
        if (!$category) {
            return redirect()->back()->withErrors('Categoría no encontrada');
        }

        $products = Product::where('category_id', $category->id)->get();
        return view('fashion', compact('category', 'products'));
    }
}
