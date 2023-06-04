<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterModel extends Model
{
    use HasFactory;
    public $table = 'water_bills'; 
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
