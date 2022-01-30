<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blogs extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='blogs';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'title',
        'image',
        'description',
        'content',
        'display',
        'hot',
        'slug',
        'blog_type_id'
    ];
    function scopeGetAll(){
        return $this::with('blogType')->orderBy('id','desc')->paginate(10);
    }
    function blogType(){
        return $this->belongsTo(
            BlogTypes::class,'blog_type_id'
        );
    }
}
