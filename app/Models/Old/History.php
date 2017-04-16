<?php

namespace App\Models\Old;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;

    protected $connection = 'mysql_old';

    protected $table = 'hm2_history';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class, 'deposit_id', 'id');
    }
}
