<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtremBloggerAdvicesTable extends Migration {

	public function up(){
        if (!Schema::hasTable('extrem_blogger_advices')) {
    		Schema::create('extrem_blogger_advices', function(Blueprint $table) {
    			$table->increments('id');
                $table->string('name', 128)->nullable();
                $table->string('author', 128)->nullable();
                $table->text('desc')->nullable();
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists('extrem_blogger_advices');
	}
}
