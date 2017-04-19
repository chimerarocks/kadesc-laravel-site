<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
    return [
        'fullImageUrl'	=> '/img/obras/terrabela.jpg',
        'imageUrl'   	=> '/img/obras/terrabela.jpg',
        'building' 		=> 'Terrabela',
        'company'		=> 'Goldztein/Living'
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'imageUrl'   	=> '/img/obras/terrabela.jpg'
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    return [
        'apresentation' => $faker->sentence(),
    	'logoUrl' => $faker->sentence(),
    	'about' => $faker->sentence(),
    	'localization' => $faker->address,
    	'contactPhone' => $faker->phoneNumber,
    	'contactEmail'  => $faker->email,
    	'serviceRowSize' => 3,
        'serviceRowQuantity' => 3
    ];
});