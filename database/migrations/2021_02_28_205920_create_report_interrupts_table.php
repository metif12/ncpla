<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportInterruptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_interrupts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Report::class);
            $table->foreignIdFor(\App\Models\Interrupt::class);
            $table->integer('length');
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
        Schema::dropIfExists('report_interrupts');
    }
}
