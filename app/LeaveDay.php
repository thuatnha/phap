<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveDay extends Model
{
    //
    protected $table = 'leave_day';

    public function users()
    {
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}
