<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FishCoordinate extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $table = 'fish_coordinates';
    public function fishs(){
        return $this->belongsTo(Fish::class,'fish_id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class,'attachable');
    }
    public function getImageUrlAttribute()
    {
        $images = $this->images;
        if ($images->isNotEmpty()) {
            return Storage::url($images->last()->path);
        }
    }
}
