<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;

class DeletedResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_deleted_response()
    {
        $request = Request::create('http://localhost');
        $response = DeletedResponse::new('User deleted.')->toResponse($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEquals('User deleted.', $response->getContent());
    }
}
