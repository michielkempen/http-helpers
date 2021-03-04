<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;

class GoneResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_gone_response()
    {
        $request = Request::create('http://localhost');
        $response = GoneResponse::new()->toResponse($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(410, $response->getStatusCode());
        $this->assertEquals('', $response->getContent());
    }
}
