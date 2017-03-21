<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('politician_id')->unsigned();
            $table->foreign('politician_id')->references('id')->on('politicians');
            $table->string('name');
            $table->date('from')->nullable();
            $table->date('until')->nullable();
        });
        Schema::table('politicians', function (Blueprint $table) {
            $table->integer('party_id')->unsigned()->comment('partidul actual')->after('contact_id');
            $table->foreign('party_id')->references('id')->on('parties');
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
            $table->dropForeign(['party_id']);
            $table->dropColumn('party_id');
        });
        Schema::dropIfExists('parties');
    }
}
