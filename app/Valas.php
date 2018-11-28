<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valas extends Model
{
    protected $fillable = ['name', 'symbol', 'buy', 'sell', 'old_buy', 'old_sell'];
    protected $appends = ['beli', 'jual', 'beli_lama', 'jual_lama'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->old_buy = $model->buy;
            $model->old_sell = $model->sell;
        });
    }
    
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

    public function getBeliLamaAttribute()
    {
        return number_format($this->old_buy, 2, ',', '.');
    }

    public function getJualLamaAttribute()
    {
        return number_format($this->old_sell, 2, ',', '.');
    }
}
