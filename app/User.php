<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'api_token', 'status', 'activation', 'path_foto', 'fcm_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'activation'
    ];

    /**
     * The attributes that should be added in json
     * 
     * @var array
     */
    protected $appends = ['foto'];

    public function setPasswordAttribute($value)
    {
        if ($value) $this->attributes['password'] = \Hash::needsRehash($value) ? \Hash::make($value) : $value;
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getTokenAttribute()
    {
        return $this->api_token;
    }

    public function getUrlActivationAttribute()
    {
        return route('activation', $this->activation);
    }

    public function getFotoAttribute()
    {
        return empty($this->path_foto) ? null : asset('storage/original/' . $this->path_foto);
    }
    
    public function broker()
    {
        return $this->hasOne(Broker::class, 'user_id', 'id');
    }
    
    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'id');
    }
}
