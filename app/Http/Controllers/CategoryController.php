<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        //
        $categories = Category::all();

        // Obtiene todas las categorías
        return view( 'categories.index', compact( 'categories' ) );
        // Envía las categorías a la vista

    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
        return view( 'categories.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {

        $validatedData = $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ] );

        // Agregar el user_id del usuario autenticado
        $validatedData[ 'user_id' ] = auth()->id();

        // Generar el slug automáticamente
        $validatedData[ 'slug' ] = Str::slug( $request->input( 'name' ), '-' );

        if ( $request->hasFile( 'image' ) ) {
            $path = $request->file( 'image' )->store( 'categories', 'public' );
            $validatedData[ 'image' ] = $path;
        }

        Category::create( $validatedData );

        return redirect()->route( 'categories.index' )->with( 'success', 'Categoría creada exitosamente.' );
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

        $category = Category::findOrFail( $id );
        return view( 'categories.edit', compact( 'category' ) );

    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        //
        $validatedData = $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ] );

        $category = Category::findOrFail( $id );

        // Agregar el user_id del usuario autenticado
        $validatedData[ 'user_id' ] = auth()->id();

        // Generar el slug automáticamente
        $validatedData[ 'slug' ] = Str::slug( $request->input( 'name' ), '-' );

        if ( $request->hasFile( 'image' ) ) {
            $path = $request->file( 'image' )->store( 'categories', 'public' );
            $validatedData[ 'image' ] = $path;
        }

        $category->update( $validatedData );

        return redirect()->route( 'categories.index' )->with( 'success', 'Categoría actualizada exitosamente.' );

    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        //
    }
}
