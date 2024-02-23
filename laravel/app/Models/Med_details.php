<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Med_details extends Model
{
    use HasFactory;

    protected $table = "_med_details";
    protected $primaryKey = "id";
    protected $fillable = [
        'Hospital',
        'National_id',
        'Payment_mode',
        'Policy_provider',
        'Policy_no',
        'Med_condition'
    ];

    public $timestamps = false;

    public function participant(){
        return $this->belongsTo(Participant::class);
    }
}
