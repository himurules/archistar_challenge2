<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAnalyticTypesTable
 */
class CreateAnalyticTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'analytic_types',
            function (Blueprint $table) {
                $table->integer('id')->unsigned();
                $table->string('name');
                $table->string('units');
                $table->boolean('is_numeric');
                $table->integer('num_decimal_places');
                $table->timestamps();
                $table->primary('id');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analytic_types');
    }
}
