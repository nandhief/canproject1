<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'alamat', 'no_hp', 'foto_ktp', 'tabungan', 'kredit'
    ];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->user()->delete();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
