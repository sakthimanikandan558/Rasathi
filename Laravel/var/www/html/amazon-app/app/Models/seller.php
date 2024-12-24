<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seller extends Model
{
    use HasFactory;
    protected $fillable = ['seller_name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
