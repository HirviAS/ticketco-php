<?php

namespace TicketCo\Laravel;

use Illuminate\Support\Facades\Facade;

class TicketCoFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'TicketCo\Client';
    }
}