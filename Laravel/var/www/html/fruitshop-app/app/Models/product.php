<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['seller_id', 'product_name', 'product_price', 'product_description'];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function orders()
    {
        return $this->hasMany(order::class);
    }

    protected $guarded = [];

    public function images(): MorphMany
    {
        return $this->morphMany(image::class, 'imageable');
    }
}
