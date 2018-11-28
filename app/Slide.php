<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'path_image', 'order', 'status', 'slide_id', 'slide_type'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['link', 'image'];
    protected $hidden = ['slide_id', 'slide_type'];

    public function getLinkAttribute()
    {
        return url('api', [$this->slide_type, $this->slide_id]);
    }

    public function getImageAttribute()
    {
        return empty($this->path_image) ? null : asset('storage/files/' . $this->path_image);
    }
}
