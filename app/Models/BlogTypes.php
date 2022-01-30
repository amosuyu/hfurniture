<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTypes extends Model
{
    use HasFactory, SoftDeletes;
     protected $table='blog_types';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'title',
        'description',
        'display',
        'slug'
    ];
    function scopeGetAll(){
        return $this->orderBy('id','desc')->paginate(10);
    }
}
