<?php

namespace App\Listeners;

use App\Events\ViewCountIncrementEvent;
use App\Models\Link;


class ViewCountIncrementListener
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


    public function handle(ViewCountIncrementEvent $event)
    {
        $link = $event->link;

        $link = Link::find($link->id);
        $link->view_count++;
        $link->save();
    }
}
