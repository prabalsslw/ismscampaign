<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionAdmin extends Model
{
    protected $table = 'permission_admin';
    protected $guarded = ['id'];
}
