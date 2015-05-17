<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');
		DB::table('schools')->insert(array(
        array('name' => 'Artesis Hogeschool Antwerpen '),
        array('name' => 'AP Hogeschool Antwerpen'),
        array('name' => 'Plantijn - Hogeschool  Lange Nieuwstraat 101 2000 Antwerpen'),
        array('name' => 'KDG campus Hoboken'),
        array('name' => 'KDG campus Groenplaats'),
        array('name' => 'KDG Louis Frarynlaan 30'),
        array('name' => 'KDG Predikerinnenstraat 18'),
        array('name' => 'KDG Oudesteenweg 2'),
        array('name' => 'KDG Pothoekstraat 1'),
        array('name' => 'KDG campus Congres'),
        array('name' => 'KDG campus Borgerhout'),
        array('name' => 'KDG campus Sint-Lucas'),
        array('name' => 'KDG Campus Zuid'),
        array('name' => 'KDG Campus Zuid'),
        array('name' => 'KU Leuven - Campus Antwerpen Sint-Andries'),
        array('name' => 'Thomas More Antwerpen - Campus Sanderus'),
        array('name' => 'Universiteit Antwerpen')
    	));
	}

}
