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
        'deleted_at', 'updated_at',
    ];

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getJenisAttribute($value)
    {
        return ucwords(str_replace('-', ' ', $value));
    }

    public function getKualifikasiAttribute($value)
    {
        return '<p>' . str_replace(';', '<br>', $value) . '</p>';
    }

    public function getKuaAttribute()
    {
        return str_replace('</p>', '', str_replace('<p>', '', str_replace('<br>', ';', $this->kualifikasi)));
    }

    public function getFasilitasAttribute($value)
    {
        return '<p>' . str_replace(';', '<br>', $value) . '</p>';
    }

    public function getFasAttribute($value)
    {
        return str_replace('</p>', '', str_replace('<p>', '', str_replace('<br>', ';', $this->fasilitas)));
    }

    public function careers()
    {
        return $this->hasMany(Career::class);
    }
}
