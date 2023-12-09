<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districte extends Model
{
    use HasFactory;
    // protected $fillable= ['name', 'city_id'];
    protected $guarded = [];

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
}
