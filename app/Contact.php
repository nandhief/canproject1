<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'posisi', 'alamat', 'telp', 'latitude', 'longitude'];
    protected $dates = ['deleted_at'];

    public function getPosisiAttribute($value)
    {
        return strtoupper($value);
    }
}
