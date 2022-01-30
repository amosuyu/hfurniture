<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collections extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'collections';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name_vi',
        'description_vi',
        'name_en',
        'description_en',
        'slug',
        'display',
        'image',
    ];

    public function scopeGetAll()
    {
        return $this->orderBy('id', 'desc')->paginate(10);
    }

}
