<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users() {
        return $this->belongsToMany('Corp\User','role_user');
    }

    public function permissions() {
        return $this->belongsToMany('Corp\Permission','permission_role');
    }

    public function hasPermission($name, $require = false){
        if(is_array($name)){
            //проверка целого массива прав
            foreach($name as $permissionName){
                if($require == true && $this->checkOnePermission($permissionName) == false)
                    return false;
                else if($require == false && $this->checkOnePermission($permissionName) == true)
                    return true;
            }
            return ($require == true) ? true : false;

        }
        else{
            //проверка только одного права
            return $this->checkOnePermission($name);
        }
    }

    private function checkOnePermission($name){
        $this->load('permissions');
        foreach ($this->permissions as $permission) {
            if ($permission->name == $name) {
                return true;
            }
        }
        return false;
    }

    public function savePermissions($inputPermissions) {

        if(!empty($inputPermissions)) {
            $this->permissions()->sync($inputPermissions);
        }
        else {
            $this->permissions()->detach();
        }

        return TRUE;
    }
}
