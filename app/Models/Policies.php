<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policies extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='policies';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'name',
        'content',
        'slug',
        'display'
    ];
}
