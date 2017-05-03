<?php

namespace spec\TicketCo;

use PhpSpec\ObjectBehavior;

class ClientSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith('your-api-key');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TicketCo\Client');
    }

    function it_should_return_a_collection_object()
    {
        $this->events()
            ->all()
            ->shouldReturnAnInstanceOf('Illuminate\Support\Collection');
    }

    function it_returns_a_single_object_when_using_get()
    {
        $event = $this->events()->all()->first();
        $this->events()
            ->get($event->id)
            ->shouldReturnAnInstanceOf('stdClass');
    }

    function it_should_fail_when_using_bad_apikey()
    {
        $this->beConstructedWith('bad-key');
        $this->events()
            ->shouldThrow('\Exception')
            ->duringAll();
    }

}