<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;

    protected $fillable=['name','code','legal_name','status','source','created_by','updated_by'];

    public function customer_contact(){
        return $this->hasMany(CustomerContact::class);
    }
}
