<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_stays', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, "user_id")->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('room_type');
            $table->string('bedroom_type');
            $table->integer('number_of_rooms')->default(0);
            $table->integer('number_of_single_rooms')->default(0);
            $table->integer('number_of_double_rooms')->default(0);
            $table->string('food_allowed');
            $table->text('note')->nullable();
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade');
            $table->foreignId('district_id')->constrained()->cascadeOnDelete();
            $table->string('city');
            $table->string('address');
            $table->string('pincode')->length(6);
            $table->integer('number_of_adults')->default(0);
            $table->integer('number_of_children')->default(0);
            $table->datetime('check_in_time');
            $table->datetime('check_out_time');
            $table->string('area');
            $table->string('guest');
            $table->string('mountain_view');
            $table->string('room_image');
            $table->string('upto_3days_prior');
            $table->string('upto_2days_prior');
            $table->string('1day_prior');
            $table->string('same_day_cancellation');
            $table->string('no_show');
            $table->string('location');
            $table->string('price');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_stays');
    }
};
