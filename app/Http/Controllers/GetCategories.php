<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GetCategories extends Controller
{
    public function index()
    {
        // Cambia los nombres de los campos a los que tienes en tu base de datos
        $categories = Category::all(['id', 'name']);
        return view('Categories', compact('categories')); // Asegúrate de pasar las categorías a la vista
    }

    public function beauty()
    {
        // Cambia el id de la categoría según corresponda
        $category = Category::where('id', 1)->first();
        if (!$category) {
            return redirect()->back()->withErrors('Categoría no encontrada');
        }
        // Ajusta el nombre del campo para filtrar productos
        $products = Product::where('category_id', $category->id)->get(); // Cambia 'id_categoria' según tu tabla products
        return view('beauty', compact('category', 'products'));
    }

    public function fashion()
    {
        // Cambia el id de la categoría según corresponda
        $category = Category::where('id', 2)->first();
        if (!$category) {
            return redirect()->back()->withErrors('Categoría no encontrada');
        }
        // Ajusta el nombre del campo para filtrar productos
        $products = Product::where('category_id', $category->id)->get(); // Cambia 'id_categoria' según tu tabla products
        return view('fashion', compact('category', 'products'));
    }
}
