<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MichielKempen\LaravelHttpResponses\Testing\User;
use MichielKempen\LaravelHttpResponses\Testing\UserTransformer;
use Orchestra\Testbench\TestCase;

class ItemResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_an_item_response()
    {
        $item = new User('John', 'Doe');
        $request = Request::create('http://localhost');
        $response = ItemResponse::new($item, UserTransformer::class)->toResponse($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'data' => ['first_name' => 'John', 'last_name' => 'Doe'],
        ], $response->getData(true));
    }
}
