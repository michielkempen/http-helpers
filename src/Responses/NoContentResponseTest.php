<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;

class NoContentResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_no_content_response()
    {
        $request = Request::create('http://localhost');
        $response = NoContentResponse::new()->toResponse($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEquals('', $response->getContent());
    }
}
