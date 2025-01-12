<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductController extends Controller {
    public function index() {
        // Obtener productos con paginación de 10 registros por página
        $products = Product::paginate( 10 );

        // Retornar la vista con los productos paginados
        return view( 'products.index', compact( 'products' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //

        //Obtener categorias ordenadas por nombre
        $categories = Category::orderBy( 'name' )->get();

        return view( 'products.create', compact( 'categories' ) );
    }

    public function store( Request $request ) {
        $validatedData = $request->validate( [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
            'is_in_carousel' => 'required|boolean',
            'images.*' => 'nullable|image|max:2048',
            'featured_image' => 'nullable|string' // Se validará después de subir las imágenes
        ] );

        // Generar slug y asignar usuario
        $validatedData[ 'slug' ] = Str::slug( $request->name );
        $validatedData[ 'user_id' ] = auth()->id();
        $validatedData[ 'created_by' ] = auth()->id();

        // Crear el producto
        $product = Product::create( $validatedData );

        // Subir imágenes y asociarlas al producto
        if ( $request->hasFile( 'images' ) ) {
            foreach ( $request->file( 'images' ) as $image ) {
                $path = $image->store( 'products', 'public' );
                $isFeatured = $request->featured_image === $image->getClientOriginalName();

                $product->images()->create( [
                    'image_path' => $path,
                    'is_featured' => $isFeatured,
                    'created_by' => auth()->id(),
                ] );
            }
        }

        return redirect()->route( 'products.index' )->with( 'success', 'Producto creado exitosamente.' );
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        //
    }
}
