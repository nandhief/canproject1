<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $fillable = ['customer_id', 'code', 'status'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->code = strtoupper(uniqid());
        });
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function histories()
    {
        return $this->morphMany(History::class, 'historytable');
    }
}
