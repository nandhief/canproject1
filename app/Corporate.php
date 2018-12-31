<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    protected $fillable = ['bagian', 'name', 'jabatan', 'path_foto'];
    protected $appends = ['foto'];


    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getFotoAttribute()
    {
        return empty($this->path_foto) ? null : asset('storage/original/' . $this->path_foto);
    }
}
