<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'slug', 'embeded', 'path_image', 'short_desc', 'description', 'status', 'highlight', 'order', 'notif'
    ];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $appends = ['image', 'youtube'];

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

    public function getYoutubeAttribute()
    {
        return empty($this->embeded) ? null : 'https://www.youtube.com/watch?v=' . $this->embeded;
    }
}
