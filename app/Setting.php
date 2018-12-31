<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title', 'data', 'status'
    ];
    protected $hidden = ['id', 'status', 'created_at', 'updated_at'];

    public function scopeSocial($query)
    {
        $socials = $query->whereTitle('social')->first();
        return json_decode($socials->data);
    }

    public function scopeMail($query)
    {
        $mail = $query->whereTitle('mail')->first();
        return json_decode($mail->data);
    }

    public function scopeAndroid($query)
    {
        $socials = $query->whereTitle('android')->first();
        return json_decode($socials->data);
    }

    public function scopeVisi($query)
    {
        return $query->whereTitle('visi')->first();
    }

    public function scopeMisi($query)
    {
        return $query->whereTitle('misi')->first();
    }

    public function scopeSejarah($query)
    {
        return $query->whereTitle('sejarah')->first();
    }
}
