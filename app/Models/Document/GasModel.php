<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasModel extends Model
{
    use HasFactory;
    public $table = 'gas_bills'; 
    protected $fillable =[
        'release_date',
        'consumption',
        'amount',
        'month',
        'year',
        'image',
        'notes',
        'user_id'
    ]; 
}

