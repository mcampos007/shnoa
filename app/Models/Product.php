<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {

    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'description',
        'stock',
        'price',
        'is_active',
        'is_in_carousel',
        'slug',
        'user_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function category() {
        return $this->belongsTo( Category::class );
    }

    public function images() {
        return $this->hasMany( ProductImage::class );
    }

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function createdBy() {
        return $this->belongsTo( User::class, 'created_by' );
    }

    public function updatedBy() {
        return $this->belongsTo( User::class, 'updated_by' );
    }

    public function deletedBy() {
        return $this->belongsTo( User::class, 'deleted_by' );
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function scopeActive( $query ) {
        return $query->where( 'is_active', true );
    }

    public function scopeInCarousel( $query ) {
        return $query->where( 'is_in_carousel', true );
    }

    public function scopeByCategory( $query, $category ) {
        return $query->where( 'category_id', $category );
    }

    public function scopeByUser( $query, $user ) {
        return $query->where( 'user_id', $user );
    }

    public function scopeBySlug( $query, $slug ) {
        return $query->where( 'slug', $slug );
    }

    public function scopeByPrice( $query, $price ) {
        return $query->where( 'price', $price );
    }

    public function scopeByStock( $query, $stock ) {
        return $query->where( 'stock', $stock );
    }

    public function scopeByActive( $query, $active ) {
        return $query->where( 'is_active', $active );
    }

    // Relación con subcategoría

    public function subcategory() {
        return $this->belongsTo( Subcategory::class );
    }

}
