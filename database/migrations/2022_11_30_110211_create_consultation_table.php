<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation', function (Blueprint $table) {
            $table->id('cnslt_id');
            $table->integer('cnslt_patient_id');
            $table->integer('cnslt_physician_id');
            $table->string('cnslt_program_office');
            $table->longText('cnslt_nnotes')->nullable();
            $table->longText('cnslt_dnotes')->nullable();
            $table->string('cnslt_bp');
            $table->string('cnslt_hr');
            $table->string('cnslt_temp');
            $table->string('cnslt_ol');
            $table->integer('cnslt_chief_complain');
            $table->string('cnslt_diagnosis');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultation');
    }
}
