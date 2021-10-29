<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    use HasFactory;

    protected $table = 'pincode';

    protected $fillable = [
        'pincode',
        'is_available'
    ];

    public function getStatusTextAttribute()
    { 
        return $this->is_available == 1 ?'<span class="badge badge-glow bg-success">Active</span>':'<span class="badge badge-glow bg-danger">InActive</span>';
    }
}
