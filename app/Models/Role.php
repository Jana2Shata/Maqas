<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'role',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
