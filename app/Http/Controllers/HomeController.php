<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductImage;

use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    // public function __construct()
    // {
    //     $this->middleware( 'auth' );
    // }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index() {

        $featuredProducts = ProductImage::with( 'product' )->where( 'is_featured', true )->get();

        return view( 'welcome', compact( 'featuredProducts' ) );
    }

    // método para contacto

    public function contact() {
        return view( 'contact' );
    }

    //Méetodo para nosotros

    public function nosotros() {
        return view( 'nosotros' );
    }

    //Método para productos

    public function products() {
        $products = Product::with( 'images' )->get();
        return view( 'products', compact( 'products' ) );
    }

}
