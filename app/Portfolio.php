<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title', 'text', 'customer', 'alias', 'img', 'filter_alias',
    ];
}
