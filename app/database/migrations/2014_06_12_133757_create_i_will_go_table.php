<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIWillGoTable extends Migration {

	public function up(){
        if (!Schema::hasTable('i_will_go')) {
    		Schema::create('i_will_go', function(Blueprint $table) {
    			$table->increments('id');
    			$table->integer('profile_id')->default(0)->unsigned()->nullable();
    			$table->string('object_type', 64)->nullable();
    			$table->integer('object_id')->default(0)->unsigned()->nullable();
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists('i_will_go');
	}

}