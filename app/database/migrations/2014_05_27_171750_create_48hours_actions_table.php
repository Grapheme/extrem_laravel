<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create48hoursActionsTable extends Migration {

    public $table = '48hours_actions';

	public function up(){
        if (!Schema::hasTable($this->table)) {
    		Schema::create($this->table, function(Blueprint $table) {
    			$table->increments('id');
                $table->string('name', 128)->nullable();
                $table->text('desc')->nullable();
                $table->string('photo', 64)->nullable();
                $table->dateTime('date_time');
    			$table->timestamps();
    		});
        }
	}

	public function down(){
		Schema::dropIfExists($this->table);
	}
}
