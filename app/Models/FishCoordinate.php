<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishCoordinate extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public function fishs(){
        return $this->belongsTo(Fish::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class,'attachable');
    }
}
