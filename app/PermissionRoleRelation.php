<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class PermissionRoleRelation extends Model
{
    protected $table = 'permission_role';

    protected $fillable = [
        'permission_id', 'role_id',
    ];
}
