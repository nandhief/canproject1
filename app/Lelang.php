<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lelang extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'slug', 'embeded', 'path_image', 'short_desc', 'description', 'status', 'highlight', 'order', 'notif'
    ];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $appends = ['image'];

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
        if ($this->path_image) {
            $images = explode('|', $this->path_image);
            foreach ($images as $image) {
                $data[] = asset('storage/files/' . $image);
            }
            return $data;
        }
        return null;
    }
}
