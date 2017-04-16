<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    public $timestamps = false;

    protected $connection = 'mysql_old';

    protected $table = 'hm2_deposits';
}
