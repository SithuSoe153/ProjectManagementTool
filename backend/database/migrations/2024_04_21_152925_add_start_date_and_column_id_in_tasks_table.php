s<?php

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
            Schema::table('tasks', function (Blueprint $table) {
                $table->date('start_date')->nullable();  // Start date for the task
                $table->unsignedBigInteger('column_id'); // Links task to a specific column

                $table->foreign('column_id')->references('id')->on('columns')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('tasks', function (Blueprint $table) {
                //
            });
        }
    };