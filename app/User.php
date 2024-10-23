<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ultraware\Roles\Traits\HasRoleAndPermission;

class User extends Authenticatable
{
    use Notifiable, HasRoleAndPermission;

    protected $casts = ['activo' => 'boolean',];

    protected $fillable = [
        'name', 'email', 'password', 'username', 'activo', 'infocheck'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

     public function scopeName($query, $name){
      if ($name != "") {
         $query-> where("users.name", "ILIKE", "%" . $name . "%");
        }         
    }

     public function scopeUsername($query, $username){
      if ($username != "") {
         $query-> where("users.username", "ILIKE", "%" . $username . "%");
        }         
    }

    public function scopeRol($query, $rol){      
        if ($rol != "") {
           $query-> where("roles.name", "=", $rol);              
        }
    }

}
