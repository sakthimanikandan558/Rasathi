<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(customer::class);
    }

    public function employee(){
        return $this->belongsTo(employee::class);
    }
}
