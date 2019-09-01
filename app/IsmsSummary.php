<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IsmsSummary extends Model
{
    //isms_summary
    protected $table = 'isms_summary';
    protected $guarded = ['id','updated_at','created_at'];
}
