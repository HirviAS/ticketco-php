<?php

namespace TicketCo;

use GuzzleHttp\Client as GuzzleClient;
use TicketCo\Resources\Events;

class Client
{

    /**
     * Endpoint for TicketCo API
     *
     * @var string
     */
    private $endpoint = 'https://ticketco.no/api/public/v1/';

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $apikey;

    /**
     * Client constructor.
     *
     * @param string $apikey
     * @param array $clientOptions
     */
    public function __construct($apikey, $clientOptions = [])
    {
        $this->apikey = $apikey;
        $this->client = new GuzzleClient(
            array_merge([
                'base_uri' => $this->endpoint,
                'query'    => ['token' => $this->apikey]
            ], $clientOptions)
        );
    }

    /**
     * @return Events
     */
    public function events()
    {
        return new Events($this->apikey, $this->client);
    }

    /**
     *
     */
    public function transactions()
    {

    }

}