<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration {

	public function up(){
        if (!Schema::hasTable('48hours_places')) {
    		Schema::create('48hours_places', function(Blueprint $table) {
    			$table->increments('id');
                $table->string('name', 128)->nullable();
                $table->text('desc')->nullable();
                $table->string('photo', 64)->nullable();
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists('48hours_places');
	}
}
