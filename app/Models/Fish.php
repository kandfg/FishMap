<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fish extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $table = 'fishs';
    public function fishCoordinates(){
        return $this->hasMany(FishCoordinate::class);
    }
    public function fishClasses(){
        return $this->belongsTo(fishClass::class,'class_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class,'attachable');
    }
}
