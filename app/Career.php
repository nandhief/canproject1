<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'posisi', 'description', 'path_resume', 'status', 'keterangan', 'reply'
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
