<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name_vi',
        'name_en',
        'description_vi',
        'content_vi',
        'description_en',
        'content_en',
        'slug',
        'image',
        'length',
        'width',
        'height',
        'price',
        'discount',
        'sold',
        'display',
        'hot',
        'collection_id',
        'category_id',
        'space_id',
        'size_id',
    ];

    public function scopeStatistical()
    {
        return $this->count();
    }

    public function collections()
    {
        return $this->belongsTo(Collections::class, 'collection_id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function details()
    {
        return $this->hasMany(ProductDetails::class, 'product_id', 'id');
    }

    public function scopeGetByHot()
    {
        return $this->with('details.colors')->where('hot', 1)->get();
    }

    public function scopeGetBySelling()
    {
        return $this->with('details.colors')->orderBy('sold', 'DESC')->limit(8)->get();
    }

    public function scopeGetByBestDeal()
    {
        return $this->with('details.colors')->where('discount', '<>', 0)->orderBy('discount', 'DESC')->limit(8)->get();
    }

}
