<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SafetySecurity extends Model
{
    protected $table    = 'safety_securities';
    protected $fillable = ['name', 'home_stay_id'];

    public function homeStay(): BelongsTo
    {
        return $this->belongsTo(HomeStay::class, 'home_stay_id');
    }
}
