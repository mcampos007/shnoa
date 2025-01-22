<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubcategoriesTableSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run() {
        $subcategories = [
            // Subcategorías para categoría 1
            [
                'name' => 'PAPEL HIGIENICO BLANCO  LARGO METRAJE OLIMP',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'PAPEL HIGIENICO BLANCO CORTO METRAJE OLIMP',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'TOALLA INTERCALADA  BEIGE',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'TOALLA INTERCALADA  BLANCO',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'TOALLA EN ROLLO ECOROL BEIGE',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'TOALLA EN ROLLO OLIMP  BLANCO',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'ROLLO COCINA',
                'category_id' => 1,
                'user_id' => 1,
            ],
            [
                'name' => 'SULFITO',
                'category_id' => 1,
                'user_id' => 1,
            ],

            // Subcategorías para categoría 2
            [
                'name' => 'BOBINAS INDUSTRIALES PURO POLAR',
                'category_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'PAÑOS WYPALL',
                'category_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'CUIDADO DE MANOS',
                'category_id' => 3,
                'user_id' => 1,
            ],

            [
                'name' => 'RESIDUOS NEGRAS',
                'category_id' => 24,
                'user_id' => 1,
            ],
            [
                'name' => 'CONSORCIO NEGRAS',
                'category_id' => 24,
                'user_id' => 1,
            ],
            [
                'name' => 'BLANCAS',
                'category_id' => 24,
                'user_id' => 1,
            ],
            [
                'name' => 'VERDES',
                'category_id' => 24,
                'user_id' => 1,
            ],
            [
                'name' => 'ROJAS',
                'category_id' => 24,
                'user_id' => 1,
            ],
            [
                'name' => 'AMARILLAS',
                'category_id' => 24,
                'user_id' => 1,
            ],

            [
                'name' => 'TRANSPARENTES',
                'category_id' => 24,
                'user_id' => 1,
            ],

            [
                'name' => 'ECO EN ROLLO',
                'category_id' => 24,
                'user_id' => 1,
            ],

        ];

        foreach ( $subcategories as $subcategory ) {
            $name = $subcategory[ 'name' ];

            DB::table( 'subcategories' )->insert( [
                'name' => $name,
                'description' => $name,
                'slug' => Str::slug( $name ),
                'category_id' => $subcategory[ 'category_id' ],
                'user_id' => $subcategory[ 'user_id' ],
                'created_at' => now(),
                'updated_at' => now(),
            ] );
        }
    }
}
