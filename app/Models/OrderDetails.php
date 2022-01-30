<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='order_details';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'quantity',
        'price',
        'product_detail_id',
        'order_id',
    ];

    public function productDetails(){
        return $this->belongsTo(ProductDetails::class,'product_detail_id')->withTrashed();
    }
}
