<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ProductImage extends Model {
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'product_id',
        'image_path',
        'is_featured',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function product() {
        return $this->belongsTo( Product::class );
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

    public function scopeFeatured( $query ) {
        return $query->where( 'is_featured', true );
    }

    public function getRouteKeyName() {
        return 'image_path';
    }

    public function delete() {
        $this->deleted_by = Auth::id();
        // Asigna el ID del usuario autenticado
        $this->save();
        // Guarda el cambio antes del soft delete
        parent::delete();
        // Llama al método original de delete()
    }

}
