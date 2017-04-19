<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/trevicorp.jpg"
        ]);

        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/riegel.jpg"
        ]);

        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/bes_.jpg"
        ]);

        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/MERIT.jpg"
        ]);

        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/goldsztein.jpg"
        ]);

        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/pdg.jpg"
        ]);

        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/Platz.jpg"
        ]);

        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/MH Construtora.JPG"
        ]);

        factory(App\Client::class)->create([
            "imageUrl"			=> "/img/clientes/Geraldo Santana.jpg"
        ]);
    }
}
