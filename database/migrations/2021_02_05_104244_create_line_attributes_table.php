<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Line::class);
            $table->string('name');
            $table->string('type');
            $table->string('unit');
            $table->string('default');
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
        Schema::dropIfExists('line_attributes');
    }
}
