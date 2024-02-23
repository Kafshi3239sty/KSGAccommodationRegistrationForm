<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_profile extends Model
{
    use HasFactory;

    protected $table = "_organization";
    protected $primaryKey = "id";
    protected $fillable = [
        'Spons_org',
        'National_id',
        'Work_st'
    ];
    public $timestamps = false;
    public function participant(){
        return $this->belongsTo(Participant::class);
    }
}
