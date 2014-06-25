<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModulesTable extends Migration {

    public $table = 'modules';

	public function up(){
        if (!Schema::hasTable($this->table)) {
        	Schema::create($this->table, function(Blueprint $table) {			
    			$table->increments('id');
    			$table->string('name')->nullable();
    			$table->boolean('on')->default(0);
    			$table->boolean('order')->default(0);
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists($this->table);
	}

}