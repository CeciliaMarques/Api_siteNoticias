<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['author_name',
                           'title','caption',
                           'date', 'text',
                           'published_at', 'status',
                           'category_id', 'user_id']; 
}