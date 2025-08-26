<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bedding extends Model
{
    protected $table    = 'beddings';
    protected $fillable = ['name', 'home_stay_id'];

    public function homeStay(): BelongsTo
    {
        return $this->belongsTo(HomeStay::class, 'home_stay_id');
    }
}
