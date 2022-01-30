<?php

namespace App\Models;

use App\Models\Languages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translates extends Model
{
    use SoftDeletes; // add soft delete
    protected $table = 'translates';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'content',
        'product_id',
        'collection_id',
        'category_id',
        'space_id',
        'language_id',
    ];

    public function languages()
    {
        return $this->belongsTo(Languages::class, 'language_id');
    }

    public function spaces()
    {
        return $this->belongsTo(Spaces::class, 'space_id');
    }


}
