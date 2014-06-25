<?php

use Illuminate\Database\Migrations\Migration;

class CreateSessionTable extends Migration {

    public $table = 'sessions';

	public function up(){
        if (!Schema::hasTable($this->table)) {
        	Schema::create($this->table, function(Blueprint $table) {			
    			$table->string('id')->unique();
    			$table->text('payload');
    			$table->integer('last_activity');
    		});
        }
	}

	public function down(){
		Schema::dropIfExists($this->table);
	}

}
