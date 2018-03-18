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
        ]);
    }
}
