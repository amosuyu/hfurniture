<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='categories';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'name_vi',
        'description_vi',
        'name_en',
        'description_en',
        'space_id',
        'slug',
        'display'
    ];

    function scopeGetAll(){
        return $this::with('Space')->orderBy('id','desc')->paginate(10);
    }
    
    function Space(){
        return $this->belongsTo(
            Spaces::class,'space_id'
        );
    }

}
