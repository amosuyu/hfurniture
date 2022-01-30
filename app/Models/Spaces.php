<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spaces extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='spaces';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'name_vi',
        'description_vi',
        'name_en',
        'description_en',
        'display',
        'slug'
    ];
    function scopeGetAll(){
        return $this->orderBy('id','desc')->paginate(10);
    }
    function categories(){
        return $this->hasMany(
            Categories::class,'space_id','id',
        );
    }
}
