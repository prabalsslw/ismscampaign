<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsStatusTb extends Model
{
    protected $table = 'sms_status_tb';
    protected $guarded = ['id','updated_at','created_at','schedulechange_time','cancel_time'];
}