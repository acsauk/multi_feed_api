<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Feed;
use App\Events\FeedCreated;

class FeedController extends Controller
{
    public function create(Request $request)
    {
        $original_feed = $this->get_json_response($request->input('url'));

        $feed = Feed::create([
          'original_feed' => $original_feed
        ]);

        event(new FeedCreated($feed));
    }

    private function get_json_response(String $url)
    {
        $client = new Client();
        return $client->get($url)->getBody();
    }
}
