<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    //relationship with user
    public function user(){

        return $this->hasMany(User::class,'role_id','id');
    }


    // relationship with permision
    public function permissions(){

        return $this->belongsToMany(permission::class);
    }


}
