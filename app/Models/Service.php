<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'icon_id'
    ];


    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function stores(){
        return $this->belongsToMany(Store::class);
    }


}
