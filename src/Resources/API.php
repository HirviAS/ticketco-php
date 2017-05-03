<?php

namespace TicketCo\Resources;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

abstract class API
{

    /**
     * @var string
     */
    protected $resource = '';

    /**
     * API constructor.
     *
     * @param string $apikey
     * @param Client $client
     */
    public function __construct($apikey, Client $client)
    {
        $this->apikey = $apikey;
        $this->client = $client;
    }

    /**
     * @param array $filters
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    protected function request($filters = [], $id = '')
    {
        if ( ! $this->apikey) {
            throw new Exception('Please provide an API key.');
        }

        return $this->makeRequest($this->resource . '/' . $id, $filters);
    }

    /**
     * @param string $resource
     * @param array $arguments
     * @return string
     * @throws Exception
     */
    private function makeRequest($resource, $arguments)
    {
        try {
            $response = $this->client->get(
                $resource,
                array_merge($this->client->getConfig('query'),$arguments)
            );

            $responseObject = json_decode($response->getBody());
            $collection = isset($responseObject->events) ? collect($responseObject->events) : $responseObject;

            return $collection;
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response instanceof ResponseInterface) {
                throw new Exception($e->getResponse()->getBody());
            }
            throw new Exception($e->getMessage());
        }
    }

}