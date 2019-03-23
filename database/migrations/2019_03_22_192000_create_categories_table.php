<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Category::tableName(), function (Blueprint $table) {
	
	        $table->increments('id');
	        $table->string('title');
	        
        });
    
        \Illuminate\Support\Facades\DB::table(Category::tableName())->insert(
            [
                'title' => 'Sample Category',
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Category::tableName());
    }
}
