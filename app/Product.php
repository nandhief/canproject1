<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'category', 'name', 'slug', 'path_image', 'icon_image', 'short_desc', 'description', 'status', 'hightlight', 'order', 'notif'
    ];
    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];
    protected $appends = ['image', 'icon'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = str_slug($model->name);
        });
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getImageAttribute()
    {
        return empty($this->path_image) ? null : asset('storage/files/' . $this->path_image);
    }

    public function getIconAttribute()
    {
        return empty($this->icon_image) ? null : asset('storage/files/' . $this->icon_image);
    }
}
