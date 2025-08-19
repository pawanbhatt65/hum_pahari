<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table      = "states";
    protected $primaryKey = "id";
    public $timestamps    = true;

    protected $fillable = [
        "name",
        "code",
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
