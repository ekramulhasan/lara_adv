<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    //relation with role
    public function role(){

        return $this->belongsToMany(Role::class)->withPivot('role_id');
    }


    //relation with module
    public function module(){

        return $this->belongsTo(Module::class);
    }
}
