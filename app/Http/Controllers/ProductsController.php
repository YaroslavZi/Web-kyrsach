<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
class ProductsController extends Controller
{
    public function getPage(Request $request, $cat)
    {
        $category = Category::where('name', $cat)->first();

        $products = Product::where('category_id', $category->id)->orderBy('price')->paginate(10);

        $brands_id = Product::where('category_id', $category->id)->distinct()->pluck('brand_id');
        $brands = array();
        foreach ( $brands_id as &$item) {
            $brand = Brand::find($item);

            $brands[] = $brand->name;
        }
        $prices = Product::where('category_id', $category->id);
        $price_range = array();
        $price_range[] = $prices->min('price');
        $price_range[] = $prices->max('price');

        $rus_category = $category->rus_name;
        $eng_category = $category->name;
        $checked_brands = $brands;
        $title = $category->rus_name;
        $sort_price = $price_range;
        return view('products', compact('title',  'products', 'brands', 'price_range',  'rus_category', 'eng_category' ,'checked_brands', 'sort_price'));
    }


    public function sort(Request $request,  $cat)
    {
        $category = Category::where('name', $cat)->first();




        $brands_id = Product::where('category_id', $category->id)->distinct()->pluck('brand_id');
        $brands = array();
        foreach ( $brands_id as &$item) {
            $brand = Brand::find($item);

            $brands[] = $brand->name;
        }

        $checked_brands = array();
        if ($request->brands != null) {
            $checked_brands = array_map(function ($value) {
                return $value;
            },  explode(',', $request->brands));


            $checked_brands = Brand::whereIn('name', $checked_brands)->get('id');
            $products = Product::where('category_id', $category->id)->where('price', '>=', $request->min_price)->where('price', '<=', $request->max_price)->whereIn('brand_id', $checked_brands);

        } else {
            $checked_brands = $brands;
            $products = Product::where('category_id', $category->id)->where('price', '>=', $request->min_price)->where('price', '<=', $request->max_price);

        }


        switch ($request->order_id) {
            case 1:
                $products = $products->orderBy('price', 'asc')->paginate(10)->withPath(URL::full());

                break;
            case 2:
                $products = $products->orderBy('price', 'desc')->paginate(10)->withPath(URL::full());
                break;
            case 3:
                $products = $products->orderBy('name', 'asc')->paginate(10)->withPath(URL::full());
                break;
            case 4:
                $products = $products->orderBy('name', 'desc')->paginate(10)->withPath(URL::full());
                break;
        }


        $prices = Product::where('category_id', $category->id);

        $price_range = array();
        $price_range[] = $prices->min('price');
        $price_range[] = $prices->max('price');
        $rus_category = $category->rus_name;
        $eng_category = $category->name;
        $title = $category->rus_name;

        $sort_price = [$request->min_price,  $request->max_price];
        return view('products', compact('title',  'products', 'brands', 'price_range',  'rus_category', 'eng_category' ,'checked_brands', 'sort_price'));
    }


}
