<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionBulk extends Model
{
    protected $table = 'permission_bulk';
    protected $guarded = ['id'];
}
