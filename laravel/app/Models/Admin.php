<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    protected $table = "_admin";
    protected $primaryKey = "National_id";
    protected $fillable = [
        'User_id',
        'Full_Names',
        'National_id'
    ];

    public function notify($instance)
    {
        return $this->forceFill(array_merge($this->toArray(), [
            'notification' => serialize($instance),
        ]));
    }
}
