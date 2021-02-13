<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Report::class);
            $table->foreignIdFor(\App\Models\Material::class);
            $table->float('value',15,3);
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
        Schema::dropIfExists('report_materials');
    }
}
