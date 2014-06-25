<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtremUserPhotosTable extends Migration {

	public function up(){
        if (!Schema::hasTable('extrem_user_photos')) {
    		Schema::create('extrem_user_photos', function(Blueprint $table) {
    			$table->increments('id');
                $table->string('image', 128)->nullable();
                $table->integer('photo_id')->default(0)->unsigned()->nullable();
                $table->integer('approved')->default(0)->unsigned()->nullable();
                $table->string('first_name', 128)->nullable();
                $table->string('last_name', 128)->nullable();
                $table->string('profile', 256)->nullable();
                $table->string('city', 64)->nullable();
                $table->string('sex', 2)->nullable();
                $table->string('photo_big', 64)->nullable();
                $table->string('bdate', 10)->nullable();
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists('extrem_user_photos');
	}
}
