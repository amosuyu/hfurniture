<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'district',
        'ward',
        'price',
        'status',
        'quantity',
        'user_id',
        'voucher_id',
        'method',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }

    public function vouchers()
    {
        return $this->belongsTo(Vouchers::class, 'voucher_id', 'id');
    }

    public function scopeInYear($query, $year)
    {
        if($year != null){
            return $query->whereYear('created_at', '=', $year);
        }else{
            return $query->whereYear('created_at', date('Y'));
        }
       
    }

    public function scopeStatistical()
    {
        return $this->where('status', 3)->sum('price');
    }

    public function payments(){
        return $this->hasOne(Payments::class, 'order_id', 'id');
    }

}
