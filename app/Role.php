<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function userss(){
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
