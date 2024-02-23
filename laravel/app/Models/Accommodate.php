<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodate extends Model
{
    use HasFactory;

    protected $table = "_attendance";
    protected $primaryKey = "id";
    protected $fillable = [
        'Course_id',
        'Participant_id',
        'Admin_id',
        'Hostels',
        'Room_No',
        'Check_in',
        'Check_out',
        'Check_in_by',
        'Check_out_by'
    ];

    public $timestamps = false;

    public function courses()
    {
        return $this->hasOne(Course::class, 'Course_id', 'id');
    }

    public function rooms()
    {
        return $this->hasOne(Rooms::class, ['Hostels', 'Room_No'], ['Hostels', 'Room_No']);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'Participant_id', 'National_id');
    }
}
