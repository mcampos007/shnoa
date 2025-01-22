<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model {
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'slug',
        'image',
        'user_id',
    ];

    /**
    * Relación con Category
    */

    public function category() {
        return $this->belongsTo( Category::class );
    }

    /**
    * Relación con User
    */

    public function user() {
        return $this->belongsTo( User::class );
    }

    // Relación con productos

    public function products() {
        return $this->hasMany( Product::class );
    }
}
