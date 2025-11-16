<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegister extends Model
{
    use HasFactory;
    protected $table = "user_registers";

    protected $fillable = ["name", "phone", "email", "check_in_time", "check_out_time", "address", "home_stay_id"];
}
