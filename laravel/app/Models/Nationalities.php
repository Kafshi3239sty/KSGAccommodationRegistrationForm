<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalities extends Model
{
    use HasFactory;

    protected $table = "nationalities";
    protected $primaryKey = "id";
    protected $fillable = [
        'Name'
    ];

    public function participants(){
        return $this->hasMany(Participant::class);
    }
}
