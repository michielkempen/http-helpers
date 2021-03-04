<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;

class ForbiddenResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_forbidden_response()
    {
        $request = Request::create('http://localhost');
        $response = ForbiddenResponse::new()->toResponse($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals('', $response->getContent());
    }
}
