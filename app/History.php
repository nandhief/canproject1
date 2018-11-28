<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['description', 'reply'];
    protected $hidden = ['historytable_type', 'historytable_id'];
    protected $appends = ['tanggal'];

    public function getTanggalAttribute()
    {
        return $this->created_at->format('d-m-Y H:s:i');
    }

    public function historytable()
    {
        return $this->morphTo();
    }
}
