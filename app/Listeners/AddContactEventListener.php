<?php

namespace App\Listeners;

use App\Events\onAddContactEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddContactEventListener
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
     * @param  onAddContactEvent  $event
     * @return void
     */
    public function handle(onAddContactEvent $event)
    {
        //
    }
}
