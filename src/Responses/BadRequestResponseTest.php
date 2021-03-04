<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;

class BadRequestResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_bad_request_response()
    {
        $request = Request::create('http://localhost');
        $response = BadRequestResponse::new('Whoops, something went wrong.')->toResponse($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('Whoops, something went wrong.', $response->getContent());
    }
}
