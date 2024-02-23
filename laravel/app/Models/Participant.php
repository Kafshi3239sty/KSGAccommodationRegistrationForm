<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Participant extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = "_participants";
    protected $primaryKey = "National_id";
    protected $fillable = [
        'User_id',
        'National_id',
        'Full_Names',
        'Country',
        'Mobile_No',
        'Gender',
        'Address'
    ];

    public $timestamps = false;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gender(){
        return $this->hasOne(Gender::class, 'Gender', 'id');
    }

    public function nationality(){
        return $this->belongsTo(Nationalities::class, 'Country', 'id');
    }

    public function work_profile(){
        return $this->hasOne(Work_profile::class);
    }

    
    public function med_details(){
        return $this->hasOne(Med_details::class);
    }

    public function accommodation(){
        return $this->hasMany(Accommodate::class);
    }
}
