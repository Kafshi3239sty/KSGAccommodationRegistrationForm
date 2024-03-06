<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;


    protected $table = "_hostels";
    protected $primaryKey = [
        'Hostels',
        'Room_No',
    ];
    protected $fillable = [
        'Hostels',
        'Room_No',
    ];

    public $timestamps = false;

    protected $casts = [
        'Hostels' => 'array', // or any other data type you want to cast "Hostels" to
    ];

    public function accommodation()
    {
        return $this->hasMany(Accommodate::class);
    }
}
