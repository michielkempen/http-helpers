<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;

class NotFoundResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_not_found_response()
    {
        $request = Request::create('http://localhost');
        $response = NotFoundResponse::new()->toResponse($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals('', $response->getContent());
    }
}
