<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory, HasRoles;

    protected $table ="permissions";

    public $incrementing = false;
    
    protected $fillable = ['name', 'guard_name'];
}
