<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserSocialInfoTable extends Migration {

	public function up(){
        if (!Schema::hasTable('user_social_info')) {
    		Schema::create('user_social_info', function(Blueprint $table) {
    			$table->increments('id');
                $table->string('profile', 128)->nullable();
                $table->string('city', 64)->nullable();
                $table->text('preferences')->nullable();
                $table->text('social_info')->nullable();
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists('user_social_info');
	}

}