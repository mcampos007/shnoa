<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Order;
use App\Models\OrderItem;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
//use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;

//use Barryvdh\DomPDF\PDF;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $categories = Category::with([
            'subcategories' => function ($query) {
                $query->with(['products' => function ($q) {
                    $q->where('stock', '>', 0)->with('images');
                }]);
            }
        ])
        ->get();
        Log::info('Categorías cargadas: ' . $categories->count());
        Log::info('Detalle de categorías: ' . $categories->toJson());
        Log::info('Detalle de productos en categorías: ' . $categories->flatMap->subcategories->flatMap->products->toJson());
        return view('products', compact('categories'));
    
    }


    public function getCategoryData(int $categoryId): JsonResponse
    {
        // Buscar la categoría con subcategorías y productos en stock
        $category = Category::with([
            'subcategories:id,name',
            'products' => function ($query) {
                $query->where('stock', '>', 0)
                    ->where('price', '>', 0)
                    ->with(['featuredOrFirstImage' => function ($q) {
                        $q->select('id', 'product_id', 'image_path');
                    }]);
            }
        ])->find($categoryId);
        // // Buscar la categoría con subcategorías y productos con la imagen destacada o la primera disponible
        // $category = Category::with([
        //     'subcategories:id,name',
        //     'products.featuredOrFirstImage' => function ($query) {
        //         $query->select('id', 'product_id', 'image_path');
        //     }
        // ])->find($categoryId);
        //     // Verificar si la categoría existe
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

        DB::beginTransaction();

        try {
            // Calcular el total del pedido
            $total = array_reduce($cart, function ($carry, $item) {
                return $carry + ($item['product']->price * $item['quantity']);
            }, 0);

            // Crear el registro de la orden
            $order = Order::create([
                'customer_name' => $request->input('name'),
                'customer_email' => $request->input('email'),
                'customer_phone' => $request->input('phone'),
                'observations' => $request->input('observation'),
                'total' => $total,
            ]);
            
            Log::info('Orden creada: ' . $order->id);

            // Crear los registros de los productos del pedido
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['product']->price,
                ]);
                Log::info('Producto agregado al pedido: ' . $item['product']->name . ' (Cantidad: ' . $item['quantity'] . ')'); 
            }

           // Generar el PDF con los detalles del pedido
           //$pdf = app(PDF::class);
           $pdf = PDF::loadView('cart.pedido_pdf', compact('order'));
           Log::info('PDF generado para el pedido: ' . $order->id);
           // $pdf = $pdf->loadView('pedido_pdf', compact('order'));
            $pdfPath = 'pedidos/pedido_' . $order->id . '.pdf';
            Storage::put('public/' . $pdfPath, $pdf->output());

            // Enviar el correo con el PDF adjunto
            // Mail::raw(
            //     "Nuevo Pedido Recibido\n\n" .
            //     "Nombre: {$order->customer_name}\n" .
            //     "Correo: {$order->customer_email}\n" .
            //     "Teléfono: {$order->customer_phone}\n\n" .
            //     "Se adjunta el PDF con los detalles del pedido.",
            //     function ($message) use ($order, $pdfPath) {
            //         $message->to('mcampos@infocam.com.ar')
            //                 ->subject('Nuevo Pedido de ' . $order->customer_name)
            //                 ->attach(Storage::path('public/' . $pdfPath));
            //     }
            // );

            Mail::send([], [], function ($message) use ($order, $pdfPath) {
                $message->to('mcampos@infocam.com.ar')
                        ->subject('Nuevo Pedido de ' . $order->customer_name)
                        ->text("Nuevo Pedido Recibido...") // Cambiado de setBody() a text()
                        ->attach(Storage::path('public/' . $pdfPath));
            });
            Log::info('Correo enviado para el pedido: ' . $order->id);

            DB::commit();

            // Limpiar el carrito
            session()->forget('cart');

            return redirect()->route('index')->with('success', 'Pedido guardado y enviado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Hubo un problema al guardar el pedido.');
        }


        // // Información del cliente
        // $customerData = $request->only('name', 'email', 'phone', 'observations');

        // // Preparar el contenido del correo
        // $orderDetails = "";
        // $total = 0;

        // foreach ($cart as $item) {
        //     $subtotal = $item['product']->price * $item['quantity'];
        //     $orderDetails .= "Producto: {$item['product']->name}\n";
        //     $orderDetails .= "Cantidad: {$item['quantity']}\n";
        //     $orderDetails .= "Precio Unitario: $" . number_format($item['product']->price, 2) . "\n";
        //     $orderDetails .= "Subtotal: $" . number_format($subtotal, 2) . "\n\n";
        //     $total += $subtotal;
        // }

        // $orderDetails .= "Total del Pedido: $" . number_format($total, 2) . "\n";
        // $orderDetails .= "Observación: " . ($customerData['observations'] ?? 'Sin observaciones') . "\n";

        // // Enviar el correo
        // Mail::raw(
        //     "Nuevo Pedido Recibido\n\n" .
        //     "Nombre: {$customerData['name']}\n" .
        //     "Correo: {$customerData['email']}\n" .
        //     "Teléfono: {$customerData['phone']}\n\n" .
        //     "Detalles del Pedido:\n" . $orderDetails,
        //     function ($message) use ($customerData) {
        //         $message->to('mcampos@infocam.com.ar')
        //                 ->subject('Nuevo Pedido de ' . $customerData['name']);
        //     }
        // );

        // // Limpiar el carrito
        // session()->forget('cart');

        // return redirect()->route('index')->with('success', 'Pedido enviado correctamente.');
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