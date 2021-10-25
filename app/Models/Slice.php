<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slice extends Model
{
    use HasFactory;

    protected $table = 'slices';

    protected $fillable = [
        'slice_image',
        'name',
        'num_of_pieces'

    ];
}
