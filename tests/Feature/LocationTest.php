<?php

namespace Tests\Feature;

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
        $location = factory(Location::class)->create();

        // Act
        // Call the relevant endpoint to get details of the location
        $response = $this->get("/api/locations/{$location->id}");

        // Assert
        // Check the location details returned are correct
        $response->assertStatus(200)->assertJson([
            'name' => $location->name,
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
            'address' => $location->address,
            'category' => $location->category,
            'link' => $location->link,
            'rating' => $location->rating,
            'image' => $location->image,
            'price' => $location->price,
        ]);
    }

    /** @test */
    public function location_is_created_via_json_payload()
    {
        // Arrange
        // Create values for JSON payload
        $name = 'Central Park';
        $latitude = '40.784083425938';
        $longitude = '-73.964853286743';
        $address = '59th St to 110th St (5th Ave to Central Park West)';
        $category = 'Park';
        $link = 'https://foursquare.com/v/412d2800f964a520df0c1fe3';
        $rating = '9.8';
        $image = 'https://igx.4sqi.net/img/general/500x500/655018_Zp3vA90Sy4IIDApvfAo5KnDItoV0uEDZeST7bWT-qzk.jpg';
        $price = 3;

        $payload = [
          'name' => $name,
          'latitude' => $latitude,
          'longitude' => $longitude,
          'address' => $address,
          'category' => $category,
          'link' => $link,
          'rating' => $rating,
          'image' => $image,
          'price' => $price
        ];

        // Act
        // Post JSON payload to locations#store route
        $this->json('post', '/api/locations', $payload)
        // Assert
        // Check the location was created (201)
            ->assertStatus(201)
        // and details returned are correct
            ->assertJson([
              'name' => $name,
              'latitude' => $latitude,
              'longitude' => $longitude,
              'address' => $address,
              'category' => $category,
              'link' => $link,
              'rating' => $rating,
              'image' => $image,
              'price' => $price
            ]);
    }

    /** @test */
    public function location_can_be_created_with_null_price()
    {
        // Arrange
        // Create values for JSON payload
        $name = 'Central Park';
        $latitude = '40.784083425938';
        $longitude = '-73.964853286743';
        $address = '59th St to 110th St (5th Ave to Central Park West)';
        $category = 'Park';
        $link = 'https://foursquare.com/v/412d2800f964a520df0c1fe3';
        $rating = '9.8';
        $image = 'https://igx.4sqi.net/img/general/500x500/655018_Zp3vA90Sy4IIDApvfAo5KnDItoV0uEDZeST7bWT-qzk.jpg';
        $price = null;

        $payload = [
          'name' => $name,
          'latitude' => $latitude,
          'longitude' => $longitude,
          'address' => $address,
          'category' => $category,
          'link' => $link,
          'rating' => $rating,
          'image' => $image,
          'price' => null
        ];

        // Act
        // Post JSON payload to locations#store route
        $this->json('post', '/api/locations', $payload)
        // Assert
        // Check the location was created (201)
            ->assertStatus(201)
        // and details returned are correct
            ->assertJson([
              'name' => $name,
              'latitude' => $latitude,
              'longitude' => $longitude,
              'address' => $address,
              'category' => $category,
              'link' => $link,
              'rating' => $rating,
              'image' => $image,
              'price' => null
            ]);
    }
}
