<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = ['id'];

    public static function findByslug($page_slug){

        return self::where('page_slug',$page_slug)->where('is_active',1)->firstOrfail();

    }
}
