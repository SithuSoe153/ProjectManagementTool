<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //      task_id: int
    // name: string
    // description: string
    // due_date: date
    // project: Projectparent_task: Task
    // position: int
    // created_at: datetime
    // updated_at: datetime

    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent_task_id')->nullable();
            // $table->integer('position')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('parent_task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};