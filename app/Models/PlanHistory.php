<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanHistory extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'planes_id', 'tipo'];

    public function planes(){
        return $this->belongsTo(Planes::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
