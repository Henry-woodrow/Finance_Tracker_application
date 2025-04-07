<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift_money extends Model
{
    use HasFactory;

    protected $table = 'gift_money'; // table name

    protected $fillable = ['user_id','amount', 'gift_name', 'gift_description']; // fillable fields
}
