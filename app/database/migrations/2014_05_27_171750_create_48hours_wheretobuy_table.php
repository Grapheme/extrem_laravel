<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create48hoursWheretobuyTable extends Migration {

	public function up(){
        if (!Schema::hasTable('48hours_wheretobuy')) {
    		Schema::create('48hours_wheretobuy', function(Blueprint $table) {
    			$table->increments('id');
                $table->string('name', 128)->nullable();
                $table->text('desc')->nullable();
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists('48hours_wheretobuy');
	}
}
