<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    //relationship with permission
    public function permissions(){

        return $this->hasMany(Permission::class,'module_id','id');
    }
}
