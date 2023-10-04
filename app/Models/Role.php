<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    //relationship with user
    public function user(){

        return $this->hasMany(User::class,'id');
    }


    // relationship with permision
    public function permissions(){

        return $this->belongsToMany(Permission::class);
    }


}
