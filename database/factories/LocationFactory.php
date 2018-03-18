<?php

use Faker\Factory as Faker;

$faker = Faker::create('en_GB');

$factory->define(App\Location::class, function ($faker) {
    return [
        'name' => $faker->company,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'address' => $faker->address,
        'category' => $faker->randomElement(
          $array = array ('Garden',
                          'Theater',
                          'Park',
                          'Art Museum',
                          'Gym / Fitness Center',
                          'Track')),
        'link' => $faker->url,
        'rating' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 9),
        'image' => $faker->imageUrl($width = 800, $height = 600, 'cats')
    ];
});
