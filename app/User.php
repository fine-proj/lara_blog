<?php

namespace Corp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany('Corp\Article', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('Corp\Comment', 'user_id', 'id');
    }

    public function roles() {
        return $this->belongsToMany('Corp\Role','role_user');
    }

    public function canDo($permission, $require=false){
        if(is_array($permission)){
            //проверка целого массива правил

           /* if($require == true)
            {
                foreach($permission as $permName){
                    if($this->checkOne($permName) == false)
                        return false;
                }
                return true;
            }
            else
            {
                foreach($permission as $permName){
                    if($this->checkOne($permName) == true)
                        return true;
                }
                return false;
            }*/

            foreach($permission as $permName){
                if($require == true && $this->checkOne($permName) == false)
                    return false;
                else if($require == false && $this->checkOne($permName) == true)
                    return true;
            }
            return ($require == true) ? true : false;

        }
        else{
            //проверка только одного правила
            return $this->checkOne($permission);
        }
    }

    private function checkOne($permission){
        $this->load('roles.permissions');

        foreach($this->roles as $role){
            foreach($role->permissions as $perm){
                if(str_is($perm->name, $permission)){
                    return true;
                }
            }
        }
        return false;
    }


    public function hasRole($name, $require=false){
        if(is_array($name)){
            //проверка целого массива ролей

            foreach($name as $roleName){
                if($require == true && $this->checkOneRole($roleName) == false)
                    return false;
                else if($require == false && $this->checkOneRole($roleName) == true)
                    return true;
            }
            return ($require == true) ? true : false;

        }
        else{
            //проверка только одной роли
            return $this->checkOneRole($name);
        }
    }

    private function checkOneRole($name){
        $this->load('roles');

        foreach($this->roles as $role){
            if($role->name == $name){
                return true;
            }
        }
        return false;
    }
}
