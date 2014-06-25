<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGalleriesTable extends Migration {

    public $table = 'galleries';

	public function up() {
        if (!Schema::hasTable($this->table)) {
        	Schema::create($this->table, function(Blueprint $table) {			
    			$table->increments('id');
    			$table->string('name');
    			$table->string('settings')->default(null);
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists($this->table);
	}

}