<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getPage(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $title = $product->name;
        return view('product', compact('title', 'product'));
    }
}
