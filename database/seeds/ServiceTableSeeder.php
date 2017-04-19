<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Service::class)->create([
        	"fullImageUrl"	=> "/img/obras/terrabela.jpg",
            "imageUrl"			=> "/img/obras/terrabela.jpg",
            "building" 		=> "Terrabela",
            "company"		=> "Goldztein/Living"
        ]);

        factory(App\Service::class)->create([
    		"fullImageUrl"	=> "/img/obras/trevicorp_maranguape_1.jpg",
            "imageUrl"			=> "/img/obras/trevicorp_maranguape_1.jpg",
            "building"		=> "Maranguape",
            "company" 		=> "Trevicorp"
        ]);

        factory(App\Service::class)->create([
        	"fullImageUrl"	=> "/img/obras/ventura.jpg",
        	"imageUrl"			=> "/img/obras/ventura.jpg",
            "building"		=> "Ventura",
            "company"		=> "Goldztein/Living"
        ]);

        factory(App\Service::class)->create([
        	"fullImageUrl"	=> "/img/obras/ideale.jpg",
            "imageUrl"			=> "/img/obras/ideale.jpg",
            "building"		=> "Ideale",
            "company"		=> "Goldztein"
        ]);

        factory(App\Service::class)->create([
        	"fullImageUrl"	=> "/img/obras/27_g.jpg",
            "imageUrl"			=> "/img/obras/27_g.jpg",
            "building"		=> "Cientec",
            "company"		=> "Merit"
        ]);

        factory(App\Service::class)->create([
	        "fullImageUrl"	=> "/img/obras/villagio.jpg",
            "imageUrl"			=> "/img/obras/villagio.jpg",
            "building"		=> "Villagio Planalto",
            "company"		=> "Goldztein\Living"
        ]);

        factory(App\Service::class)->create([
        	"fullImageUrl"	=> "/img/obras/arboretto.jpg",
            "imageUrl" 		=> "/img/obras/arboretto.jpg",
            "building"		=> "Arboretto Green Life",
            "company"		=> "Terrabela"
        ]);

        factory(App\Service::class)->create([
        	"fullImageUrl" 	=> "/img/obras/vivare.jpg",
            "imageUrl"			=> "/img/obras/vivare.jpg",
            "building"		=> "Vivare",
            "company"		=> "Goldztein/Living"
        ]);

        factory(App\Service::class)->create([
        	"fullImageUrl"	=> "/img/obras/miraflores_-g.jpg",
            "imageUrl"			=> "/img/obras/miraflores_-g.jpg",
            "building"		=> "Miraflores",
            "company"		=> "Goldztein\Living"
        ]);
    }
}
