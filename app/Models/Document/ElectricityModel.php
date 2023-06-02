<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricityModel extends Model
{
    use HasFactory;
    public $table = 'electricity_bills'; 
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
