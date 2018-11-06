<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacancy extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'lokasi', 'jenis', 'kualifikasi', 'fasilitas', 'expired',
    ];
    protected $dates = [
        'deleted_at', 'created_at', 'updated_at', 'expired',
    ];

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getJenisAttribute($value)
    {
        return ucwords(str_replace('-', ' ', $value));
    }

    public function careers()
    {
        return $this->hasMany(Career::class);
    }
}
