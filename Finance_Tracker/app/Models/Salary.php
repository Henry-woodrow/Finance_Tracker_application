<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salary'; // Specify the table name explicitly
    protected $primaryKey = 'user_id'; // Specify the primary key if it's not 'id'
    public $incrementing = false; // Set to false if the primary key is not auto-incrementing
    protected $keyType = 'int'; // Set the type if the primary key is an integer

    protected $fillable = [
        'user_id',
        'pretax_amount',
        'posttax_amount',
        'created_at',
        'updated_at',
    ];
}
