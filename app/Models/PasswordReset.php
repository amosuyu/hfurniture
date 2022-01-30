<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $table='password_resets';
    protected $fillable = [
        'id',
        'email',
        'token',
    ];
}
