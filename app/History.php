<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $timestamps = false;

    protected $table = 'hm2_history';

    protected $guarded = [];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'user_id', 'id');
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class, 'deposit_id', 'id');
    }
}
