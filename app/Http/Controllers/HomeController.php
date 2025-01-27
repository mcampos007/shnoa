<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;

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
        // Obtener las categorías con sus subcategorías y los productos dentro de cada subcategoría
        $categories = Category::with( [ 'subcategories.products.images' ] )->get();

        // Retornar la vista con los datos estructurados
        return view( 'products', compact( 'categories' ) );
    }

    public function getCategoryData(int $categoryId): JsonResponse
    {
        // Buscar la categoría
        $category = Category::with('subcategories', 'products')->find($categoryId);

        // Verificar si la categoría existe
        if (!$category) {
            return response()->json([
                'error' => 'Categoría no encontrada.',
            ], 404);
        }

        return response()->json([
            'subcategories' => $category->subcategories->map(function ($subcategory) {
                return [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                ];
            }),
            'products' => $category->products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'price' => $product->price,
                    'image_path' => $product->image_path,
                ];
            }),
        ]);
    }

        /**
     * Retorna los productos de una subcategoría específica.
     */
    public function getSubcategoryProducts(int $subcategoryId): JsonResponse
    {
        // Buscar la subcategoría
        $subcategory = Subcategory::with('products')->find($subcategoryId);

        // Verificar si la subcategoría existe
        if (!$subcategory) {
            return response()->json([
                'error' => 'Subcategoría no encontrada.',
            ], 404);
        }

        return response()->json([
            'products' => $subcategory->products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'price' => $product->price,
                    'image_path' => $product->image_path,
                ];
            }),
        ]);
    }


}


//     public function getCategoryDetails($categoryId)
// {
//     // Recupera la categoría con subcategorías, productos e imágenes
//     $category = Category::with([
//         'subcategories.products.images' // Carga subcategorías, productos e imágenes
//     ])->findOrFail($categoryId);

//     // Formatear los datos si es necesario
//     $category->subcategories->each(function ($subcategory) {
//         $subcategory->products->each(function ($product) {
//             // Añade un campo adicional que contenga las URLs de las imágenes
//             $product->images = $product->images->map(function ($image) {
//                 return [
//                     'url' => $image->url,
//                     'is_featured' => $image->is_featured
//                 ];
//             });
//         });
//     });

//     return response()->json($category);
// }


