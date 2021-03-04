<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Orchestra\Testbench\TestCase;

class ContentResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_content_response()
    {
        $content = ['first_name' => 'John', 'last_name' => 'Doe'];
        $request = Request::create('http://localhost');
        $response = ContentResponse::new($content)->toResponse($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'data' => ['first_name' => 'John', 'last_name' => 'Doe'],
        ], $response->getData(true));
    }
}
