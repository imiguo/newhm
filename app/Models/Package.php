<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function plans()
    {
        return  $this->hasMany(Plan::class, 'package_id', 'id');
    }
}
