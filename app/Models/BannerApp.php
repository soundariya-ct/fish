<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerApp extends Model
{
    use HasFactory;

    protected $table = 'app_banner';

    protected $fillable = [
        'banner_image',
    ];

}
