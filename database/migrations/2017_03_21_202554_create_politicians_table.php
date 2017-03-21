<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politicians', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->string('position')->comment('funcția actuală');
            $table->text('intersections_at_events')->nullable();
            $table->text('known_for')->nullable();
            $table->text('liason')->nullable();
            $table->integer('reasonability_rating');
            $table->integer('openness_rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('politicians', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
            $table->dropForeign(['party_id']);
        });
        Schema::dropIfExists('politicians');
    }
}
