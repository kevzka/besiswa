<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = Product::where('title', 'like', "%$search%")->get();

        return view('products.index', ['results' => $results]);
    }
    public function index()
{
    // Misalnya tampilkan halaman pencarian atau semua produk
    return view('products.index');
}

}
