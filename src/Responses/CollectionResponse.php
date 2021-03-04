<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class CollectionResponse implements Responsable
{
	protected Collection $collection;
	protected $transformer;

	public function __construct(Collection $collection, string $transformerClass)
	{
		$this->collection = $collection;
		$this->transformer = new $transformerClass;
	}

    public static function new(Collection $collection, string $transformerClass): self
    {
        return new static($collection, $transformerClass);
    }

	/**
	 * Create an HTTP response that represents the object.
	 *
	 * @param  Request $request
	 * @return JsonResponse
	 */
	public function toResponse($request)
	{
        return new JsonResponse([
			'data' => $this->transformData($request),
		]);
	}

	protected function transformData(Request $request): array
	{
		$items = $this->collection->map(function($model) use ($request) {
            return $this->transformer->transform($model, $request);
        });

		return $items->toArray();
	}
}
