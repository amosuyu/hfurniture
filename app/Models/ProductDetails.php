<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetails extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='product_details';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'images',
        'quantity',
        'color_id',
        'product_id',
    ];

    public function colors(){
        return $this->belongsTo(Colors::class,'color_id');
    }

    public function products(){
        return $this->belongsTo(Products::class,'product_id')->withTrashed();
    }


}
