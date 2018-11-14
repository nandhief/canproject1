<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'alamat', 'no_hp', 'foto_ktp', 'tabungan_status', 'credit_status', 'jenis_kelamin', 'tgl_lahir'
    ];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $appends = ['ktp'];

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->user()->delete();
        });
    }

    public function setTglLahirAttribute($value)
    {
        $this->attributes['tgl_lahir'] = now()->parse($value)->format('Y-m-d');
    }

    public function getKtpAttribute()
    {
        return empty($this->foto_ktp) ? null : asset('storage/original/' . $this->foto_ktp);
    }

    public function getTglLahirAttribute()
    {
        return empty($this->attributes['tgl_lahir']) ? null : now()->parse($this->attributes['tgl_lahir'])->format('d-m-Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function credit()
    {
        return $this->hasOne(Credit::class);
    }

    public function tabungan()
    {
        return $this->hasOne(Tabungan::class);
    }

    public function careers()
    {
        return $this->hasMany(Career::class);
    }
}
