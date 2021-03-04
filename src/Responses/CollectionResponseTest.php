<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use MichielKempen\LaravelHttpResponses\Testing\User;
use MichielKempen\LaravelHttpResponses\Testing\UserTransformer;
use Orchestra\Testbench\TestCase;

class CollectionResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_collection_response()
    {
        $collection = new Collection([ new User('John', 'Doe'), new User('Jane', 'Doe') ]);
        $request = Request::create('http://localhost');
        $response = CollectionResponse::new($collection, UserTransformer::class)->toResponse($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'data' => [
                ['first_name' => 'John', 'last_name' => 'Doe'],
                ['first_name' => 'Jane', 'last_name' => 'Doe'],
            ]
        ], $response->getData(true));
    }
}
