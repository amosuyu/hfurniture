<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ='users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'gender',
        'phone',
        'idgroup',
        'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function scopefilterQ($query, $request){
        if ($request->has('filterQ') && $request->filterQ != "") {
            $query->where('idgroup', $request->filterQ); 
        }
        return $query;
    }
    public function scopefilterSL($query, $request){
        if (!$request->has('filterSL')) {
            $request->filterSL = 10;
   
        }
        $query = $request->filterSL;
        return $query;
      
    }
    public function scopefilterKW($query,$request){
        if ($request->has('filterKeyword') && $request->filterKeyword != "") {
            $query->where('name', 'LIKE', '%' . $request->filterKeyword . '%')
                ->orWhere('id','LIKE','%' . $request->filterKeyword . '%')
                ->orWhere('email','LIKE','%' . $request->filterKeyword . '%')
                ->orWhere('diachi','LIKE','%' . $request->filterKeyword . '%')
                ->orWhere('created_at','LIKE','%' . $request->filterKeyword . '%');
               
        }
        return $query;
    }
    public function scopefilterSort($query,$request){
        if($request->has('sort') && $request->has('direction')){
            $query->orderBy($request->sort,$request->direction);
        }
        return $query;
    }

    public function scopeStatistical()
    {
        return $this->count();
    }
}

