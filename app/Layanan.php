<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'slug', 'embeded', 'path_image', 'short_desc', 'description', 'status', 'highlight', 'order'
    ];
    
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = str_slug($model->name);
        });
    }

    public function getImageAttribute()
    {
        return asset('storage/files/' . $this->path_image);
    }
}
