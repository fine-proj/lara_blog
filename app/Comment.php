<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text', 'name', 'email', 'site', 'parent_id', 'user_id', 'article_id',
    ];
}
