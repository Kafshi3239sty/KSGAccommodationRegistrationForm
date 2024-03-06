<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "_course";
    protected $primaryKey = "id";
    protected $fillable = [
        'National_id',
        'Course_Title'
    ];

    public $timestamps = false;

    public function participant(){
        return $this->belongsTo(Participant::class);
    }

    public function accommodations(){
        return $this->hasMany(Participant::class);
    }
}
