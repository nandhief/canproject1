<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vacancy_id', 'user_id', 'name', 'email', 'phone', 'posisi', 'description', 'path_resume', 'status', 'keterangan', 'reply'
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
