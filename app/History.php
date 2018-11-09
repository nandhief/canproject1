<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['description', 'reply'];
    protected $hidden = ['historytable_type', 'historytable_id'];

    public function historytable()
    {
        return $this->morphTo();
    }
}
