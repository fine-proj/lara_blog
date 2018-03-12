<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'text', 'desc', 'alias', 'img', 'user_id', 'category_id',
    ];
}
