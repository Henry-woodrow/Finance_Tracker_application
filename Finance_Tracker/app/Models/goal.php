<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class goal extends Model
{
    use HasFactory;

    protected $table = 'goals'; // table name

    protected $fillable = ['user_id','id' ,'goal_name', 'goal_amount', 'due_date', 'current_amount', 'target_amount'];
}
