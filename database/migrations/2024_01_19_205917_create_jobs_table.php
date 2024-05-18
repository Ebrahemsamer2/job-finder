<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('job_type');
            $table->string('country');
            $table->string('city');
            $table->string('open_positions');
            $table->string('experience_needed');
            $table->integer('salary_range_from');
            $table->integer('salary_range_to');
            $table->text('description');
            $table->text('requirements');
            $table->text('skills');
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(User::class);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
