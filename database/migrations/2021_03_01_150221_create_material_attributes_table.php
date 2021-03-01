<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Material::class);
            $table->string('name');
            $table->string('type');
            $table->string('unit')->nullable();
            $table->string('default')->nullable();
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
        Schema::dropIfExists('material_attributes');
    }
}
