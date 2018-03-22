<?php

namespace App\Listeners;

use App\Events\FeedCreated;
use App\Location;
use App\Provider;

class SaveProviderAndLocationsFromFeed
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FeedCreated  $event
     * @return void
     */
    public function handle(FeedCreated $event)
    {
        // Translate feed into Provider and Location
        $feedObject = json_decode($event->feed->original_feed, false);

        $provider_name = $feedObject->data->location->provider->name;
        $provider = Provider::create(['name' => $provider_name]);

        $locations = $feedObject->data->locations;

        // Iterate over locations and save each to Location
        foreach ($locations as $location)
        {
          $location = Location::create([
            'name' => $location->name,
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
            'address' => $location->address,
            'category' => $location->category,
            'link' => $location->link,
            'rating' => $location->rating,
            'image' => $location->image,
            'price' => $location->price
          ]);

          $location->provider()->associate($provider)->save();
        }

        // Add a check when consuming the original feed to compare against existing feeds. If there are matches in locations then get rid of the matches and only pass on the new locations to be created in the db
    }
}
