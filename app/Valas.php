<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valas extends Model
{
    protected $fillable = ['name', 'symbol', 'buy', 'sell'];
    protected $appends = ['beli', 'jual'];
    
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    
    public function getSymbolAttribute($value)
    {
        return strtoupper($value);
    }

    public function getBeliAttribute()
    {
        return number_format($this->buy, 2, ',', '.');
    }

    public function getJualAttribute()
    {
        return number_format($this->sell, 2, ',', '.');
    }
}
