<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class RoleUserRelation extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'user_id', 'role_id',
    ];
}
