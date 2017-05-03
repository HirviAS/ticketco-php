<?php

namespace TicketCo\API;

class Events extends API
{

    /**
     * @var string
     */
    protected $resource = 'events';

    /**
     * @param array $filters Makes it possible to filter/search by providing one or more of these params;
     *                          tags            - Filter by tags. E.g ['tags' => 'teater,standup']
     *                          title           - Filter by title. E.g ['title' => 'red']
     *                          street_address  - ['street_address' => 'Oslo']
     *                          location        - Location name: ['location' => 'Concert']
     *                          start_at        - Exact start date: ['start_at' => '2017-1-1']
     * @return mixed
     */
    public function all($filters = [])
    {
        return $this->request($filters);
    }

    public function get($id)
    {
        return $this->request([], $id);
    }

}