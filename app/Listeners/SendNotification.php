<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PostCreatedNotification;
use Illuminate\Support\Facades\Notification;

class SendNotification
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
     * @param  \App\Events\PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {

        dd();
        $website = $event->website;
        $post = $event->post;

        Notification::send($website->subscribers, new PostCreatedNotification($post));

        $post->update([
            'notified' => true
        ]);
    }
}
