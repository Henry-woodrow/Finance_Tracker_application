<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;

    // Define the table if it's not the plural of the model name
    protected $table = 'finances';

    // Define any fillable fields
    protected $fillable = ['amount'];
}
