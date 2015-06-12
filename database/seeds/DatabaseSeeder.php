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
        
        array('name' => 'AP - Campus Spoor Noord', 'lat' => 51.229788, 'lng' => 4.41716),
        array('name' => 'AP - Campus Lange Nieuwstraat', 'lat' => 51.219461, 'lng' => 4.411982),
        array('name' => 'Thomas More - Campus National', 'lat' => 51.211847, 'lng' => 4.398007),
        array('name' => 'KDG - campus Hoboken', 'lat' => 51.173479, 'lng' => 4.370757),
        array('name' => 'KDG - Stadscampus - Groenplaats', 'lat' => 51.218153, 'lng' => 4.400903),
        array('name' => 'KDG - Campus Linkeroever', 'lat' => 51.222239, 'lng' => 4.376206),
        array('name' => 'KDG - campus Noord - Oudesteenweg', 'lat' => 51.226781, 'lng' => 4.421052),
        array('name' => 'KDG - Pothoekstraat 1', 'lat' => 51.226076, 'lng' => 4.436523),
        array('name' => 'KDG - campus congres', 'lat' => 51.218394, 'lng' => 4.429523),
        array('name' => 'KDG - campus Borgerhout', 'lat' => 51.213046, 'lng' => 4.440395),
        array('name' => 'KDG - campus Sint-Lucas', 'lat' => 51.207213, 'lng' => 4.412252),
        array('name' => 'KDG - Campus Zuid', 'lat' => 51.199204, 'lng' => 4.403573),
        array('name' => 'Thomas More - Campus Sanderus', 'lat' => 51.216284, 'lng' => 4.397254),
        array('name' => 'UA,stadscampus', 'lat' => 51.222305, 'lng' => 4.409694),
        array('name' => 'Hogere Zeevaartschool', 'lat' => 51.240545, 'lng' => 4.39816),
        array('name' => 'AP - Campus Kronenburg', 'lat' => 51.211978, 'lng' => 4.399815),
        array('name' => 'AP- Campus Meistraat', 'lat' => 51.216135, 'lng' => 4.410647),
        array('name' => 'Koninklijk Conservatorium Antwerpen','lat' => 51.193869, 'lng' => 4.403592),
        array('name' => 'KDG - Campus Zuid - Markgravelei', 51.199204, 'lng' => 4.403573),
        array('name' => 'KDG - campus Stadswaag', 'lat' => 51.22366, 'lng' => 4.404824),
        array('name' => 'Thomas More - Campus Sint-andries', 'lat' => 51.216284, 'lng' => 4.397254),
        array('name' => 'UA, Campus Drie Eiken', 'lat' => 51.161801, 'lng' => 4.404981),
        array('name' => 'UA, Campus Middelheim', 'lat' => 51.18503, 'lng' => 4.418993),
        array('name' => 'UA , Campus Groenenborger', 'lat' => 51.17738, 'lng' => 4.415646)

    	));
	}

}
