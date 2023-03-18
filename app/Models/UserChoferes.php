<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChoferes extends Model
{
    use HasFactory;

    protected $connection = 'pgsqlChoferes';
    protected $table = 'users';
}
