<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Benefit extends Model
{
    protected $table    = 'benefits';
    protected $fillable = ['name', 'home_stay_id'];

    // Inverse Relationship
    public function homeStay(): BelongsTo
    {
        return $this->belongsTo(HomeStay::class, 'home_stay_id');
    }
}
