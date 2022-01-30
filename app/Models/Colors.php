<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete
class Colors extends Model
{

    use SoftDeletes; // add soft delete
    use HasFactory;
    protected $table='colors';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'name',
        'code',
    ];
    function scopeGetAll(){
        return $this->orderBy('id','desc')->paginate(10);
    }
    
}
