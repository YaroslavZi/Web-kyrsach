<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
{
    public function getPage(Request $request)
    {

            $title = 'Магазин художественных товаров ArtShop';
            $latest =   Product::latest('id')->take(10)->get();
            return view('index', compact('title'));

    }

    public function getLatest(Request $request)
    {

            return Product::latest('id')->take(5)->get();

    }



}
