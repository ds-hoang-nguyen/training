<?php

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
        Schema::create('time_sheet_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('time_sheet_id');
            $table->bigInteger('task_id')->nullable();
            $table->string('task_content');
            $table->double('work_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_sheet_details');
    }
};
