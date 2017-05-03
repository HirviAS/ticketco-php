# TicketCo API - PHP Client [![Build Status](https://travis-ci.org/HirviAS/ticketco-php.svg?branch=master)](https://travis-ci.org/HirviAS/ticketco-php)

* [Installation](#installation)
* [Laravel Users](#laravel-users)
    * [Service Provider](#service-provider)
    * [Facade](#facade)
    * [Configuration](#configuration)
* [Usage](#usage)
    * [Initialize](#initialize)
    * [Get all events](#fetch-all-events)
    * [Get single event](#get-single-event)
    * [Get event status](#get-event-status)
* [Collection object](#collection-object)
* [Further documentation](#further-documentation)

# Installation
Add the following to your composer.json

```json
{
    "require": {
        "hirvi/ticketco-php": "dev-master"
    }
}
```

# Laravel Users
We've added some classes to help Laravel 5 users make use of the library with ease.

#### Service Provider
You can register our [service provider](http://laravel.com/docs/5.4/providers) in your `app.php` config file.

```php
// config/app.php
'providers' => [
    ...
    TicketCo\Laravel\TicketCoServiceProvider::class
]
```

#### Facade
If you prefer [facades](http://laravel.com/docs/5.4/facades), make sure you add this as well:

```php
// config/app.php
'aliases' => [
    ...
    'TicketCo' => TicketCo\Laravel\TicketCoFacade::class
]
```

#### Configuration
There are only one configuration option you need to fill in. Publish the config by running:

    php artisan vendor:publish

Now, the config file will be located under `config/ticketco.php`:

```php
<?php
return [
    /*
    |--------------------------------------------------------------------------
    | TicketCo API key
    |--------------------------------------------------------------------------
    |
    | To obtain an API key, contact TicketCo or fill out this form:
    | https://app.pipefy.com/public_form/155824
    |
    */
    'apikey' => ''
];
```

# Usage

#### Initialize
Unless you are using the Laravel Facade, you need to initialize the client by passing it the API-key.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

$ticketco = new TicketCo\Client('api-key');
```

#### Fetch all events

```php
<?php
// Fetch all events
$events = $ticketco->events()->all();

// ... or if you are using the Laravel Facade
$events = TicketCo::events()->all();

// Using the Collection object, you can
// loop through all events using `each(callback)`
$events->each(function($event) {
    echo $event->title;
});

// ... or you can use foreach like with any other object/array
foreach($events as $event) {
    echo $event->title;
}

// ... or if you don't like the Collection object
// you can transform it into an array
$events = $events->toArray();
```

#### Get single event

```php
// Fetch single event
$event = $ticketco->events()->get('<id>');
echo $event->title;
```

#### Get event status
Check whether the event is available or has ended. 

```php
$status = $ticketco->events()->status('<id>'); // Will return "available" or "ended".
```

# Collection object
Queries will return an instance of the [Illuminate\Support\Collection](http://laravel.com/api/master/Illuminate/Support/Collection.html) object, which is really easy to work with. If you don't want to use the Collection object however, you can transform it into an array using `$result->toArray()`.

# Further documentation
TicketCo's API documentation is located here; http://apidoc.ticketco.no/api/v1/public.
