<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeStayImages extends Model
{
    protected $table    = 'home_stay_images';
    protected $fillable = ['image_path', 'home_stay_id'];

    public function homeStay(): BelongsTo
    {
        return $this->belongsTo(HomeStay::class, 'home_stay_id');
    }
}
