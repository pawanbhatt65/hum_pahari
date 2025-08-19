<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table      = "cities";
    protected $primaryKey = "id";
    public $timestamps    = true;

    protected $fillable = [
        "name",
        "district_id",
        "pincode",
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

}
