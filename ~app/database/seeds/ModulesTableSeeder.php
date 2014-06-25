<?php

class ModulesTableSeeder extends Seeder{

	public function run(){
		
		Module::create(array(
			'url' => 'seo',
			'on' => 0,
			'permissions'=> '[]'
		));
		Module::create(array(
			'url' => 'news',
			'on' => 1,
			'permissions'=> '[1,2,3,4,5,6]'
		));
		Module::create(array(
			'url' => 'articles',
			'on' => 0,
			'permissions'=> '[1,2,3,4,5,6]'
		));
		Module::create(array(
			'url' => 'pages',
			'on' => 1,
			'permissions'=> '[1,2,3,4,5,6]'
		));
		Module::create(array(
			'url' => 'catalogs',
			'on' => 0,
			'permissions'=> '[1,2,3,4,5,6]'
		));
		Module::create(array(
			'url' => 'users',
			'on' => 1,
			'permissions'=> '[1,2,3]'
		));
		Module::create(array(
			'url' => 'downloads',
			'on' => 1,
			'permissions'=> '[3,5,6]'
		));
		Module::create(array(
			'url' => 'statistic',
			'on' => 1,
			'permissions'=> '[]'
		));
		Module::create(array(
			'url' => 'galleries',
			'on' => 1,
			'permissions'=> '[1,2,3,4,5,6]'
		));
		Module::create(array(
			'url' => 'languages',
			'on' => 1,
			'permissions'=> '[1,2,3,4]'
		));
		Module::create(array(
			'url' => 'settings',
			'on' => 1,
		));
		Module::create(array(
			'url' => 'templates',
			'on' => 1,
			'permissions'=> '[]'
		));
		Module::create(array(
			'url' => 'i18n_news',
			'on' => 1,
			'permissions'=> '[1,2,3,4,5,6]'
		));
		Module::create(array(
			'url' => 'i18n_pages',
			'on' => 1,
			'permissions'=> '[1,2,3,4,5,6]'
		));

	}

}