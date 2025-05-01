<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weekly extends Model
{
    use HasFactory;

    protected $table = 'weekly'; // table name

    protected $fillable = ['user_id', 'amount', 'date', 'weekly_total'];
}
