<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    use HasFactory;

    protected $table = 'settings'; // table name

    protected $fillable = ['user_id','setting_id' ,'setting_name', 'setting_value', 'is_default'];
}
