<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index( $id ) {
        // Obtener la categoría por ID
        $category = Category::with( 'subcategories' )->findOrFail( $id );

        // Pasar los datos a la vista
        return view( 'subcategories.index', compact( 'category' ) );
    }
    //

    /**
    * Show the form for creating a new resource.
    */

    public function create( $categoryId ) {
        $category = Category::findOrFail( $categoryId );
        return view( 'subcategories.create', compact( 'category' ) );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        // Validar los datos
        $validatedData = $request->validate( [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ] );

        // Generar el slug automáticamente
        $validatedData[ 'slug' ] = Str::slug( $request->input( 'name' ), '-' );

        // Manejar la imagen si se sube
        if ( $request->hasFile( 'image' ) ) {
            $validatedData[ 'image' ] = $request->file( 'image' )->store( 'subcategories', 'public' );
        }

        // Agregar user_id
        $validatedData[ 'user_id' ] = auth()->id();

        // Crear la subcategoría
        Subcategory::create( $validatedData );

        // Redirigir al índice de subcategorías de la categoría específica
        return redirect()->route( 'subcategories.index', [ 'id' => $validatedData[ 'category_id' ] ] )
        ->with( 'success', 'Subcategoría creada exitosamente.' );
    }

    /**
    * Display the specified resource.
    */

    public function show( Subcategory $subcategory ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( $categoryId, $id ) {

        // Obtener la categoría asociada al ID
        $category = Category::findOrFail( $categoryId );

        // Obtener la subcategoría asociada a la categoría
        $subcategory = Subcategory::findOrFail( $id );

        // Retornar la vista con los datos necesarios
        return view( 'subcategories.edit', [
            'category' => $category,
            'subcategory' => $subcategory
        ] );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, $categoryId, $id ) {

        // Validar los datos del formulario
        $validatedData = $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'slug' => 'required|string|unique:subcategories,slug,' . $id, // Validar slug único excepto el actual
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ] );

        // Generar el slug automáticamente
        $validatedData[ 'slug' ] = Str::slug( $request->input( 'name' ), '-' );

        // Obtener la categoría y subcategoría
        $category = Category::findOrFail( $categoryId );
        $subcategory = Subcategory::findOrFail( $id );

        // Actualizar los campos de la subcategoría
        $subcategory->name = $validatedData[ 'name' ];
        $subcategory->description = $validatedData[ 'description' ] ?? $subcategory->description;
        $subcategory->slug = $validatedData[ 'slug' ];

        // Manejar la actualización de la imagen
        if ( $request->hasFile( 'image' ) ) {
            // Eliminar la imagen anterior si existe
            if ( $subcategory->image ) {
                Storage::disk( 'public' )->delete( $subcategory->image );
            }

            // Guardar la nueva imagen
            $subcategory->image = $request->file( 'image' )->store( 'subcategories', 'public' );
        }

        // Guardar los cambios

        $subcategory->save();

        // Redirigir con un mensaje de éxito
        return redirect()
        ->route( 'subcategories.index', $category->id )
        ->with( 'success', 'Subcategoría actualizada exitosamente.' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( $categoryId, $id ) {

        // Verificar que la categoría exista
        $category = Category::findOrFail( $categoryId );

        // Verificar que la subcategoría exista y esté asociada a la categoría
        $subcategory = Subcategory::where( 'category_id', $categoryId )->findOrFail( $id );

        // Eliminar la imagen asociada si existe
        if ( $subcategory->image ) {
            Storage::disk( 'public' )->delete( $subcategory->image );
        }

        // Eliminar la subcategoría
        $subcategory->delete();

        // Redirigir al índice de subcategorías con un mensaje de éxito
        return redirect()
        ->route( 'subcategories.index', $category->id )
        ->with( 'success', 'Subcategoría eliminada exitosamente.' );
    }

    // En tu controlador de Subcategory

    public function getSubcategoriesByCategory( $categoryId ) {
        $subcategories = Subcategory::where( 'category_id', $categoryId )->get();
        return response()->json( $subcategories );
    }

}
