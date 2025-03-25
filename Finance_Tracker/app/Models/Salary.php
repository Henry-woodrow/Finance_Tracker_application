<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salary'; // table name

    protected $fillable = ['user_id','pretax_amount' ,'posttax_amount'];
}
