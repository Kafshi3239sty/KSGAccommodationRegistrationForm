<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NOK extends Model
{
    use HasFactory;

    protected $table = "_n_o_k";
    protected $primaryKey = "id";
    protected $fillable = [
        'user_id',
        'Full_Names',
        'Relationship',
        'Mobile_No',
        'Address'
    ];

    public $timestamps = false;
}
