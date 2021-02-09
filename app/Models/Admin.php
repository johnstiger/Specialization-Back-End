<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasApiTokens,HasFactory;
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token'
    ];
    protected $hidden = [
        'password',
        'api_token'
    ];
}
