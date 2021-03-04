<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;

class UnprocessableEntityResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_an_unprocessable_entity_response()
    {
        $request = Request::create('http://localhost');
        $response = UnprocessableEntityResponse::new()->toResponse($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('', $response->getContent());
    }
}
