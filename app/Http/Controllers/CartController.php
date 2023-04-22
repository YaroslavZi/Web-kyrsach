<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function load(Request $request)
    {
        $title = 'Корзина';


        return view('cart', compact('title'));
    }

    public function getData(Request $request)
    {
        $products = array();
        $totalprice = 0;
        if (session('carts') != 0) {
            $arr = session('carts');
            foreach ($arr as &$value) {
                $product = Product::find($value[0]);
                $products[] =  $product;
                $totalprice +=  $product->price;
            }
            return [$products, $totalprice];
        }
    }


    public function addToCart(Request $request)
    {
        if (session('carts') != 0) {
            $arr = session('carts');
            foreach ($arr as &$value) {
                if ($value[0] == $request->id) return false;
            }
        }

        session()->push('carts',  [$request->id, 1]);
        session(['cart_count' => count(session('carts'))]);

        return session('cart_count');
    }

    public function removeFromCart(Request $request)
    {
        $arr = session('carts');
        if (count($arr) > 1) {
            foreach ($arr as &$value) {
                if ($value[0] == intval($request->id)) {
                    $key = array_search($value, $arr, true);
                    unset($arr[$key]);
                }
            }
            session(['carts' => $arr]);

            session(['cart_count' => count(session('carts'))]);


            $totalprice = 0;

            foreach (session('carts') as &$value) {
                $product = Product::find($value[0]);
                $products[] =  $product;
                $totalprice +=  $product->price;
            }
        } else {
            session(['cart_count' => 0]);

            session()->forget('carts');
            $products[] = null;
            $totalprice = 0;
        }
        return [$products, $totalprice];
    }

    public function addOrder(Request $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $delivery = $request->delivery;


        if (Auth::check()) {
            foreach (session('carts') as &$value) {
                Order::create([
                    'status' => 'not completed',
                    'count' => $value[1],
                    'price' => (int)Product::find($value[0])->price  * (int)$value[1],
                    'user_id' => Auth::user()->id,
                    'product_id' => (int)$value[0],
                    'delivery' => $delivery,
                    'name' => $name,
                    'phone' => $phone,

                ]);
                $product = Product::find($value[0]);

                $product->count = $product->count - (int)$value[1];

                $product->save();
            }
        } else {
            foreach (session('carts') as &$value) {
                Order::create([
                    'status' => 'not completed',
                    'count' => $value[1],
                    'price' => (int)Product::find($value[0])->price  * (int)$value[1],
                    'product_id' => $value[0],
                    'delivery' => $delivery,
                    'name' => $name,
                    'phone' => $phone,

                ]);
                $product = Product::find($value[0]);

                $product->count = $product->count - (int)$value[1];

                $product->save();
            }
        }


        return true;
    }

    public function cartCount(Request $request)
    {
        $arr = session('carts');
        foreach ($arr as &$value) {
            if ($value[0] == intval($request->id)) {
                $key = array_search($value, $arr, true);


                $arr[$key][1] = intval($request->count);
            }
        }
        session(['carts' => $arr]);
        return $arr;
    }

    public function clearCart(Request $request)
    {
        session(['carts' => 0]);
        session(['cart_count' => 0]);

    }
}
