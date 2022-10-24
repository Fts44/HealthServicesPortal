<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryEquipmentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_equipment_type', function (Blueprint $table) {
            $table->id('iet_id');
            $table->string('iet_type');
            $table->boolean('iet_status');
        });

        DB::table('inventory_equipment_type')->insert([
            'iet_id' => '1',
            'iet_type' => 'none',
            'iet_status' => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_equipment_type');
    }
}
