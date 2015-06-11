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
        array('name' => 'AP Hogeschool - Campus Kronenburg'),
        array('name' => 'AP Hogeschool - Campus Lange Nieuwstraat'),
        array('name' => 'AP Hogeschool - Campus Meistraat'),
        array('name' => 'AP Hogeschool - Campus Spoor Noord'),
        array('name' => 'Hogere Zeevaartschool'),
        array('name' => 'Karel De Grote Hogeschool - campus Congres'),
        array('name' => 'Karel De Grote Hogeschool - campus Borgerhout'),
        array('name' => 'Karel De Grote Hogeschool - campus Sint-Lucas'),
        array('name' => 'Karel De Grote Hogeschool - Campus Zuid'),
        array('name' => 'Karel De Grote Hogeschool - Campus Linkeroever'),
        array('name' => 'Karel De Grote Hogeschool - Pothoekstraat 1'),
        array('name' => 'Karel de Grote-Hogeschool - campus Stadswaag'),
        array('name' => 'Karel de Grote-Hogeschool - campus Noord - Oudesteenweg'),
        array('name' => 'Karel de Grote-Hogeschool - campus Hoboken'),
        array('name' => 'Karel de Grote-Hogeschool - Campus Zuid - Markgravelei'),
        array('name' => 'Karel de Grote-Hogeschool - Stadscampus - Groenplaats'),
        array('name' => 'Koninklijk Conservatorium Antwerpen'),
        array('name' => 'Thomas More Antwerpen - Campus Congres'),
        array('name' => 'Thomas More Antwerpen - Campus Sanderus'),
        array('name' => 'Thomas More Antwerpen - Campus Sint-andries'),
    	));
	}

}
