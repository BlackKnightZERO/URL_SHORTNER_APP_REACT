<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    use HasFactory;
    protected $fillable = ['long_url', 'short_url', 'user_id', 'visit_count', 'created_at', 'updated_at'];
}
