<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'order',
    ];

    public function scopeParents(Builder $builder)
    {
        $builder->whereNull('parent_id');
    }

    public function scopeOrdered(Builder $builder, $direction = 'ASC')
    {
        $builder->orderBy('order', $direction);
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
