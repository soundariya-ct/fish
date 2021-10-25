<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getParent()
    {
        return $this->hasOne($this,'id','parent_id');
    }

    public function getCategory()
    {
       return $this->hasMany($this,'parent_id')->select(['id','name','status','parent_id']);
    }

    public function getChildrenCategory()
    {
        return $this->getCategory()->with('getChildrenCategory');
    }

    public function getParentNameAttribute()
    {
       return $this->parent_id?@$this->getParent->name:'-';
    }

    public function getStatusTextAttribute()
    {
        return $this->status == 1?'<span class="badge badge-glow bg-success">Active</span>':'<span class="badge badge-glow bg-danger">InActive</span>';
    }

}
