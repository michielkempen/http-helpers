<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use MichielKempen\LaravelHttpResponses\Testing\User;
use MichielKempen\LaravelHttpResponses\Testing\UserTransformer;
use Orchestra\Testbench\TestCase;

class PaginatedResponseTest extends TestCase
{
    /** @test */
    public function it_can_instantiate_a_paginated_response()
    {
        $paginator = new LengthAwarePaginator([ new User('John', 'Doe'), new User('Jane', 'Doe') ], 2, 5);
        $request = Request::create('http://localhost');
        $response = PaginatedResponse::new($paginator, UserTransformer::class)->toResponse($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'data' => [
                ['first_name' => 'John', 'last_name' => 'Doe'],
                ['first_name' => 'Jane', 'last_name' => 'Doe'],
            ],
            'meta' => [
                'pagination' => [
                    'total' => 2,
                    'per_page' => 5,
                    'current_page' => 1,
                    'total_pages' => 1
                ]
            ]
        ], $response->getData(true));
    }
}
