<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'tbl_categories';
    protected $fillable = [
        'name', 'img'
    ];
    public $timestamps = false;

    public function stories()
    {
    return $this->hasMany('App\Story');
    }

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
