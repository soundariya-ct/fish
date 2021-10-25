<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->name??'-';
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 1?'<span class="badge badge-glow bg-success">Active</span>':'<span class="badge badge-glow bg-danger">InActive</span>';
    }

    public function product_gallery()
    {
       return $this->hasMany(ProductGallery::class);
    }

}
