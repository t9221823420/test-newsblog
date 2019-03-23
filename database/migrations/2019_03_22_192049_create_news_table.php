<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\News;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create( News::tableName(), function (Blueprint $table) {
		
		    $table->increments('id');
		    $table->timestamps();
		
		    $table->string('title');
		    $table->integer('category_id')->unsigned();
		    $table->text('text');
		
		    $table->foreign('category_id')
		          ->references('id')->on(\App\Models\Category::tableName())
		          ->onUpdate('cascade')
		          ->onDelete('restrict');
		
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( News::tableName());
    }
}
