<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Location;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function location_details_are_returned_in_valid_json()
    {
        // Arrange
        // Create a location
        $name = 'Central Park';
        $lat = '40.784083425938';
        $long = '-73.964853286743';
        $address = '59th St to 110th St (5th Ave to Central Park West)';
        $category = 'Park';
        $link = 'https://foursquare.com/v/412d2800f964a520df0c1fe3';
        $rating = '9.8';
        $image = 'https://igx.4sqi.net/img/general/500x500/655018_Zp3vA90Sy4IIDApvfAo5KnDItoV0uEDZeST7bWT-qzk.jpg';

        $location = factory(Location::class)->create([
            'name' => $name,
            'latitude' => $lat,
            'longitude' => $long,
            'address' => $address,
            'category' => $category,
            'link' => $link,
            'rating' => $rating,
            'image' => $image,
        ]);

        // Act
        // Call the relevant endpoint to get details of the location
        $response = $this->get("/api/locations/location?id={$location->id}");

        // Assert
        // Check the location details returned are correct
        $response->assertStatus(200)->assertJson([
            'name' => $name,
            'latitude' => $lat,
            'longitude' => $long,
            'address' => $address,
            'category' => $category,
            'link' => $link,
            'rating' => $rating,
            'image' => $image,
        ]);
    }
}
