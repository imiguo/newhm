<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    protected $connection = 'mysql_old';

    protected $table = 'hm2_users';
}
