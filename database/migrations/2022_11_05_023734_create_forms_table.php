<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id("form_id");
            $table->date("form_date_created");
            $table->date("form_date_updated")->nullable();
            $table->integer("form_created_by");
            $table->integer("form_patient_id");
            $table->string("form_type");
            $table->boolean("form_editable")->default(0);
            $table->integer("form_org_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}
