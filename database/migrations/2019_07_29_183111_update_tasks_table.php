<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTasksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table): void {
            $table->renameColumn('assignedto', 'assigned_to');
        });

        Schema::table('tasks', function (Blueprint $table): void {
            $table->renameColumn('taskname', 'task_name');
        });

        Schema::table('tasks', function (Blueprint $table): void {
            $table->renameColumn('attachfile', 'attach_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
}
