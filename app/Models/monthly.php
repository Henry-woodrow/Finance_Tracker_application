<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monthly extends Model
{
    use HasFactory;

    protected $table = 'monthly'; // Explicitly specify the table name

    protected $fillable = [
        'user_id',
        'amount',
        'date',
        'total_monthly',
    ];
}