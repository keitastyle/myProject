<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function(Blueprint $table){
            $table->increments('id');
            $table->integer('mentor_id')->unsigned()->index();
            $table->string("title");
            $table->string("type");
            $table->string("theme");
            $table->text("description");
            $table->string("location");
            $table->date("beginning_date");
            $table->date("ending_date")->nullable();
            $table->string("status");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("projects");
    }
}
