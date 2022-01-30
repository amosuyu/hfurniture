<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table='payments';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'amount',
        'status',
        'trade_code',
        'trade_date',
        'bank_code',
        'bank_pay_code',
        'type',
        'user_id',
        'order_id'
    ];
}
