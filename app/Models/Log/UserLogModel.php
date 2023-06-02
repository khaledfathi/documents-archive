<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogModel extends Model
{
    use HasFactory;
    public $table='user_logs';
    protected $fillable=[
        'time', 
        'ip_address', 
        'user_agent', 
        'user_id',
    ]; 
}
