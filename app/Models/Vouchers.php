<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vouchers extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='vouchers';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'code',
        'description',
        'amount',
        'percent',
        'end_date',
    ];
    function scopeGetAll(){
        return $this->orderBy('id','desc')->paginate(10);
    }
}
