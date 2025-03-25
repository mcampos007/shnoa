<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductImage;

class ProductController extends Controller {
    public function index(Request $request)
    {
        // Obtener el término de búsqueda ingresado por el usuario
        $search = $request->input('search');

        // Obtener productos con paginación de 10 registros por página
        $products = Product::withTrashed()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        // Retornar la vista con los productos paginados
        return view('products.index', compact('products', 'search'));
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
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
            'is_in_carousel' => 'required|boolean',
            'images.*' => 'nullable|image|max:2048',
            'featured_image' => 'nullable|string',
        ] );

        // Generar slug y asignar usuario
        $validatedData[ 'slug' ] = Str::slug( $request->name );
        $validatedData[ 'user_id' ] = auth()->id();
        $validatedData[ 'created_by' ] = auth()->id();
        $validatedData[ 'subcategory_id' ] = $request->subcategory_id;
        // Asignar el campo manualmente

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
        $product = Product::findOrFail( $id );
        $categories = Category::orderBy( 'name' )->get();

        $subcategories = $product->category_id
        ? Subcategory::where( 'category_id', $product->category_id )->get()
        : collect();

        return view( 'products.edit', compact( 'product', 'categories', 'subcategories' ) );

    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        // Validar los datos recibidos
        $validatedData = $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id', // Validar la subcategoría como opcional
            'is_in_carousel' => 'nullable|boolean',

        ] );

        // Buscar el producto por su ID
        $product = Product::findOrFail( $id );

        // Actualizar los datos del producto
        $product->update( [
            'name' => $validatedData[ 'name' ],
            'description' => $validatedData[ 'description' ],
            'stock' => $validatedData[ 'stock' ],
            'price' => $validatedData[ 'price' ],
            'category_id' => $validatedData[ 'category_id' ],
            'subcategory_id' => $validatedData[ 'subcategory_id' ] ?? null, // Establecer null si no se envía
            'updated_by' => auth()->id(), // Registrar el usuario que realizó la actualización
            'is_in_carousel' => $request->has( 'is_in_carousel' ),
        ] );

        // Redirigir con un mensaje de éxito
        return redirect()->route( 'products.index' )
        ->with( 'success', 'Producto actualizado exitosamente.' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        // Buscar el producto por su ID
        $product = Product::findOrFail( $id );

        // Registrar el usuario que elimina el producto
        $product->deleted_by = auth()->id();
        $product->save();

        // Aplicar soft delete
        $product->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route( 'products.index' )
        ->with( 'success', 'Producto eliminado exitosamente.' );
    }

    public function restore( string $id ) {
        $product = Product::withTrashed()->findOrFail( $id );

        $product->restore();

        return redirect()->route( 'products.index' )
        ->with( 'success', 'Producto restaurado exitosamente.' );
    }

    public function manageImages( $id ) {
        $product = Product::findOrFail( $id );

        $images = $product->images()->orderByDesc( 'is_featured' )->get();

        // Destacada primero
        return view( 'products.manage_images', compact( 'product', 'images' ) );
    }

    public function storeImage( Request $request, $id ) {
        $product = Product::findOrFail( $id );

        $request->validate( [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ] );

        $imagePath = $request->file( 'image' )->store( 'products', 'public' );

        ProductImage::create( [
            'product_id' => $product->id,
            'image_path' => $imagePath,
            'is_featured' => false,
            'created_by' => auth()->id(),
        ] );

        return redirect()->route( 'products.images.manage', $product->id )
        ->with( 'success', 'Imagen subida exitosamente.' );
    }

    public function destroyImage( $id, $image_id ) {
        $product = Product::findOrFail( $id );

        $image = ProductImage::findOrFail( $image_id );

        if ( $image->product_id !== $product->id ) {
            abort( 403, 'No autorizado.' );
        }

        $image->delete();

        return redirect()->route( 'products.images.manage', $product->id )
        ->with( 'success', 'Imagen eliminada exitosamente.' );
    }

    public function featureImage( $product_id,  $image_id ) {
        $product = Product::findOrFail( $product_id );
        $image = ProductImage::findOrFail( $image_id );

        if ( $image->product_id !== $product->id ) {
            abort( 403, 'No autorizado.' );
        }

        ProductImage::where( 'product_id', $product->id )->update( [ 'is_featured' => false ] );
        $image->update( [ 'is_featured' => true ] );

        return redirect()->route( 'products.images.manage', $product->id )
        ->with( 'success', 'Imagen destacada actualizada exitosamente.' );
    }

}
