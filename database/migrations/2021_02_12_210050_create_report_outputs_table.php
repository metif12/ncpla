<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_outputs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Report::class);
            $table->foreignIdFor(\App\Models\Product::class);
            $table->foreignId('input_id')->nullable();
            $table->string('code');
            $table->float('progress',15,3);
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
        Schema::dropIfExists('report_outputs');
    }
}
