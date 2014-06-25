<?php

class UserTableSeeder extends Seeder{

	public function run(){
		
		#DB::table('users')->truncate();

		User::create(array(
            'group_id'=>1,
			'name'=>'Администратор',
			'surname'=>'',
			'email'=>'admin@localho.st',
			'active'=>1,
			'password'=>Hash::make('FFJ2hq7qcpfn'),
			'photo'=>'img/avatars/male.png',
			'thumbnail'=>'img/avatars/male.png',
			'temporary_code'=>'',
			'code_life'=>0,
		));

		User::create(array(
            'group_id'=>3,
			'name'=>'Пользователь',
			'surname'=>'',
			'email'=>'user@localho.st',
			'active'=>1,
			'password'=>Hash::make('000000'),
			'photo'=>'img/avatars/male.png',
			'thumbnail'=>'img/avatars/male.png',
			'temporary_code'=>'',
			'code_life'=>0,
		));

		User::create(array(
            'group_id'=>3,
			'name'=>'Модератор',
			'surname'=>'',
			'email'=>'moder@localho.st',
			'active'=>1,
			'password'=>Hash::make('111111'),
			'photo'=>'img/avatars/male.png',
			'thumbnail'=>'img/avatars/male.png',
			'temporary_code'=>'',
			'code_life'=>0,
		));
	}

}