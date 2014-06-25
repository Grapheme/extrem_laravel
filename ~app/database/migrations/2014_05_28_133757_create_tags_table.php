<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {

	public function up(){
        if (!Schema::hasTable('tags')) {
    		Schema::create('tags', function(Blueprint $table) {
    			$table->increments('id');
                $table->string('module', 64)->nullable();
                $table->integer('unit_id')->default(0)->unsigned()->nullable();
                $table->string('tag', 128)->nullable();
    			$table->timestamps();
           		$table->index('module');
           		$table->index(array('module', 'unit_id'));
           		$table->unique(array('module', 'unit_id', 'tag'));
           		$table->index('tag');
    		});
        }
	}

	public function down(){
		Schema::dropIfExists('tags');
	}

}