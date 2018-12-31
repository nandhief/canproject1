<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commodity extends Model
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
        return number_format($this->buy, 0, ',', '.');
    }

    public function getJualAttribute()
    {
        return number_format($this->sell, 0, ',', '.');
    }

    public function getBeliLamaAttribute()
    {
        return number_format($this->old_buy, 0, ',', '.');
    }

    public function getJualLamaAttribute()
    {
        return number_format($this->old_sell, 0, ',', '.');
    }
}
