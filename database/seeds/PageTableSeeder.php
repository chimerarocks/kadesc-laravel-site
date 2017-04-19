<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Page::class)->create([
        	'apresentation' => '<h1 id="homeHeading">Confie na qualidade.</h1>',
	    	'logoUrl' => '/img/logo1.png',
	    	'about' => '<p class="text-faded">Kadesc Esquadrias de Alumínio, por mais de vinte anos tem fornecido a seus clientes
                    soluções em esquadrias de aluminio. 
                </p> <p class="text-faded">
                    Tendo como principais objetivos funcionalidade e
                    custo-beneficio unificados com a mais alta qualidade de produção. 
                    Desenvolve esquadrias, desde as mais simples até as mais complexas.',
            'aboutTitle' => '<h2>Uma empresa sólida</h2>',
	    	'localization' => 'Rodovia RS020, Nº 1286 - Morada do Vale I - Gravataí/RS',
	    	'localizationMapUrl' => 'https://www.google.com.br/maps?cbp=13,307.13,,0,-5.97&layer=c&panoid=Fc568lpzCceBmfBDqyYyew&cbll=-29.92573,-51.055967&dg=opt&ie=UTF8&t=m&ll=-29.979175,-51.056213&spn=0.18676,0.385895&z=11&source=embed',
	    	'contactPhone' => '(51) 3490.2300',
	    	'contactEmail'  => 'contato@kadesc.com.br',
            'serviceRowSize' => 3,
            'serviceRowQuantity' => 3
        ]);
    }
}
