<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishClass extends Model
{
    use HasFactory;
    protected $table = 'classes';
    protected $guarded = [''];
    public function fishs(){
        return $this->hasMany(Fish::class,'class_id');
    }
}
