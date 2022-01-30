<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    use HasFactory;
    protected $table = 'replies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'content',
        'reply_parent',
        'user_id',
        'comment_id',
    ];
}
