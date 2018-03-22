<?php

namespace Tests\Feature;

use Tests\TestCase;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Feed;
use App\Location;

class FeedTest extends TestCase
{

  use RefreshDatabase;
    /**
     * @test
     */
    public function external_news_feed_json_is_persisted_in_feeds_table()
    {
        // Arrange
        $external_feed_url = 'https://content-api.hiltonapps.com/v1/places/top-places/usa-nycny-fsq?access_token=jobs383-UgWfVvxQXNhDQLw4v';

        // Act
        $this->get("/api/feed?url={$external_feed_url}");

        // Assert
        $persisted_feed = Feed::first()->original_feed;

        $this->assertJson($persisted_feed);
    }

    /**
     * @test
     */
    public function locations_from_external_feed_are_saved_as_location_models()
    {
        // Arrange
        $external_feed_url = 'https://content-api.hiltonapps.com/v1/places/top-places/usa-nycny-fsq?access_token=jobs383-UgWfVvxQXNhDQLw4v';

        // Act
        $this->get("/api/feed?url={$external_feed_url}");

        // Assert
        $feed_locations = json_decode(Feed::first()->original_feed, false)->data->locations;

        foreach($feed_locations as $feed_location)
        {
            $feed_locations_names[] = $feed_location->name;
        }

        $persisted_locations = Location::all();

        foreach($persisted_locations as $persisted_location)
        {
            $this->assertContains($persisted_location->name, $feed_locations_names);
        }
    }
}