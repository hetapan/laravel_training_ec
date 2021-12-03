<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * ホーム画面の表示
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = new Product;
        $products = $product->Where('delete_flg', FALSE)->orderBy('turn', 'desc')->get()->toArray();
        return view('index',['products' => $products]);
    }
}
