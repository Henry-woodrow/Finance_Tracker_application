<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    use HasFactory;

    protected $table = 'bills'; // table name

    protected $fillable = ['user_id', 'bill_id', 'bill_name', 'amount', 'due_date']; // fillable fields
}
