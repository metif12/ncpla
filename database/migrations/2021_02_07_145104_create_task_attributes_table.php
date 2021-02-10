<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Task::class);
            $table->foreignIdFor(\App\Models\Line::class);

            $table->string('name');
            $table->string('type');
            $table->string('unit')->nullable();
            $table->string('value');
            $table->string('description')->nullable();
            $table->string('merge_type');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_attributes');
    }
}
