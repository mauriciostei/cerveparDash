<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiersHours extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function tiers(){
        return $this->belongsTo(Tiers::class);
    }
}
