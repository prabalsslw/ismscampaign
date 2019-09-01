<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignHistory extends Model
{
	protected $table = 'campaign_history';
    protected $guarded = ['id','updated_at','created_at'];
}
