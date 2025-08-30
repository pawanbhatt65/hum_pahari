<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeStay extends Model
{
    protected $table = 'home_stays';

    public static array $is_approved = [true, false];

    protected $fillable = ['user_id', 'name', 'room_type', 'bedroom_type', 'number_of_rooms', 'number_of_single_rooms', 'number_of_double_rooms', 'food_allowed', 'note', 'state_id', 'district_id', 'city', 'address', 'pincode', 'number_of_adults', 'number_of_children', 'check_in_time', 'check_out_time', 'area', 'guest', 'mountain_view', 'room_image', 'upto_3days_prior', 'upto_2days_prior', '1day_prior', 'same_day_cancellation', 'no_show', 'location', 'price', 'is_approved'];

    // many-to-One Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    // One-to-Many Relationships
    public function benefits(): HasMany
    {
        return $this->hasMany(Benefit::class, 'home_stay_id');
    }

    public function commonSpaces(): HasMany
    {
        return $this->hasMany(CommonSpace::class, 'home_stay_id');
    }

    public function safetySecurities(): HasMany
    {
        return $this->hasMany(SafetySecurity::class, 'home_stay_id');
    }

    public function beddings(): HasMany
    {
        return $this->hasMany(Bedding::class, 'home_stay_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(HomeStayImages::class, 'home_stay_id');
    }
}
