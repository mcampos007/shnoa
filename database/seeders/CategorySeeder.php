<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        $categories = [
            'PAPELES',
            'SERVILLETAS',
            'REJILLAS',
            'FRANELAS',
            'REPASADORES',
            'TRAPO PISO',
            'MICROFIBRA',
            'SEIQ - ECOMAX - QUIMICOS',
            'AEROSOLES',
            'LIMPIADORES Y AROMATIZANTES',
            'LIMPIEADORES DESENGRASANTES',
            'CUIDADO DE LA COCINA',
            'LIMP. Y ABRILL. DE ELEMENT. DE PLATA',
            'LAVANDERIA',
            'LIMPIEZA Y TRATAMIENTO DE PISOS - Sistema ACRILICOS',
            'CERAS PARA MADERA',
            'CURADORES HIDROFUGOS PARA PISOS',
            'EMULSIONES ACRILICAS ALTO TRANSITO',
            'LIMPIEZA Y TRATAMIENTO DE SUPERFICIES',
            'LIMPIEZA DE ALFOMBRAS',
            'LIMPIADORES DESINFECTANTES',
            'COSMETICA DEL AUTOMOTOR',
            'LINEA OLIMP',
            'BOLSAS',
        ];

        foreach ( $categories as $category ) {
            Category::create( [
                'name' => $category,
                'description' => $category, // Puedes ajustar la descripción según sea necesario
                'user_id' => 1,
                'slug' => Str::slug( $category ),
            ] );
        }
    }
}

