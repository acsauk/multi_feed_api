<?php

namespace App\Events;

use App\Events\Event;
use App\Feed;

class FeedCreated extends Event
{
    public $feed;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }
}
