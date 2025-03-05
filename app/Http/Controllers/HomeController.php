<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $featuredProducts = ProductImage::forCarousel()->get();
        //dd($featuredProducts);
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
    //    $category = Category::with('subcategories', 'products')->find($categoryId);
        // Buscar la categoría con subcategorías y productos con la imagen destacada o la primera disponible
        // $category = Category::with([
        //     'subcategories:id,name',
        //     'products.featuredOrFirstImage' => function ($query) {
        //         $query->select('id', 'product_id', 'image_path');
        //     }
        //     ])->find($categoryId);

        // Buscar la categoría con subcategorías y productos con la imagen destacada o la primera disponible
    $category = Category::with([
        'subcategories:id,name',
        'products.featuredOrFirstImage' => function ($query) {
            $query->select('id', 'product_id', 'image_path');
        }
    ])->find($categoryId);


        // Verificar si la categoría existe
        if (!$category) {
            return response()->json([
                'error' => 'Categoría no encontrada.',
            ], 404);
        }

        // return response()->json([
        //     'subcategories' => $category->subcategories->map(function ($subcategory) {
        //         return [
        //             'id' => $subcategory->id,
        //             'name' => $subcategory->name,
        //         ];
        //     }),
        //     'products' => $category->products->map(function ($product) {
        //         return [
        //             'id' => $product->id,
        //             'name' => $product->name,
        //             'stock' => $product->stock,
        //             'price' => $product->price,
        //             'image_path' => $product->image_path,
        //         ];
        //     }),
        // ]);

        return response()->json([
            'subcategories' => $category->subcategories->map(function ($subcategory) {
                return [
                    'id' => $subcategory->id,
                    'name' => $subcategory->name,
                ];
            }),
            'products' => $category->products->map(function ($product) {
                // Verifica si el producto tiene una imagen destacada o la primera imagen disponible
                $imagePath = $product->featuredOrFirstImage ? $product->featuredOrFirstImage->image_path : null;

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'stock' => $product->stock,
                    'price' => $product->price,
                    'image_path' => $imagePath,  // Usar la imagen cargada desde la relación
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
        // $subcategory = Subcategory::with('products')->find($subcategoryId);
        // Buscar la subcategoría con los productos y sus imágenes
        $subcategory = Subcategory::with('products.images')->find($subcategoryId);


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
                    'image_path' => $product->images->isNotEmpty()
                    ? asset('storage/' . $product->images->first()->image_path)
                    : asset('images/default.png'), // Imagen por defecto si no hay imagen asociada

                ];
            }),
        ]);
    }

    public function cart() {
        // Obtener el carrito de la sesión
        $cart = session()->get('cart', []);
        return view( 'cart.index' , compact( 'cart' ) );
    }

    public function viewAddToCart( $id ) {
        $product = Product::with( 'images' )->find( $id );

        return view( 'cart.add', compact( 'product' ) );
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('id');
        $quantity = intval($request->input('quantity', 1)); // Asegura que sea un número entero
        $product = Product::with('images')->find($productId);

        // Obtener el carrito de la sesión
        $cart = session()->get('cart', []);

        // Si el producto ya está en el carrito, se aumenta la cantidad
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }

    // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);
        // Redirigir a la página del carrito
        return redirect()->route('wc-products');
    }

    // Actualizar la cantidad de un producto en el carrito
    public function updateQuantity(Request $request)
    {
        $cart = session('cart', []);
        $index = $request->input('index');
        $quantity = max((int)$request->input('quantity'), 1);

        if (isset($cart[$index])) {
            $cart[$index]['quantity'] = $quantity;
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Cantidad actualizada correctamente.');
    }

    // Eliminar un producto del carrito
    public function removeItem(Request $request)
    {
        $cart = session('cart', []);
        $index = $request->input('index');

        if (isset($cart[$index])) {
            unset($cart[$index]);
            session(['cart' => array_values($cart)]); // Reindexa el array
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    public function sendOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'observation' => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // Información del cliente
        $customerData = $request->only('name', 'email', 'phone', 'observations');

        // Preparar el contenido del correo
        $orderDetails = "";
        $total = 0;

        foreach ($cart as $item) {
            $subtotal = $item['product']->price * $item['quantity'];
            $orderDetails .= "Producto: {$item['product']->name}\n";
            $orderDetails .= "Cantidad: {$item['quantity']}\n";
            $orderDetails .= "Precio Unitario: $" . number_format($item['product']->price, 2) . "\n";
            $orderDetails .= "Subtotal: $" . number_format($subtotal, 2) . "\n\n";
            $total += $subtotal;
        }

        $orderDetails .= "Total del Pedido: $" . number_format($total, 2) . "\n";
        $orderDetails .= "Observación: " . ($customerData['observations'] ?? 'Sin observaciones') . "\n";

        // Enviar el correo
        Mail::raw(
            "Nuevo Pedido Recibido\n\n" .
            "Nombre: {$customerData['name']}\n" .
            "Correo: {$customerData['email']}\n" .
            "Teléfono: {$customerData['phone']}\n\n" .
            "Detalles del Pedido:\n" . $orderDetails,
            function ($message) use ($customerData) {
                $message->to('mcampos@infocam.com.ar')
                        ->subject('Nuevo Pedido de ' . $customerData['name']);
            }
        );

        // Limpiar el carrito
        session()->forget('cart');

        return redirect()->route('index')->with('success', 'Pedido enviado correctamente.');
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


