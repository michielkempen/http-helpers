<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use MichielKempen\LaravelHttpResponses\Transformers\Transformer;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class CollectionResponse implements Responsable
{
	/**
	 * @var Collection
	 */
	protected $collection;

	/**
	 * @var Transformer
	 */
	protected $transformer;

	/**
	 * CollectionResponse constructor.
	 *
	 * @param Collection $collection
	 * @param string $transformerClass
	 */
	public function __construct(Collection $collection, string $transformerClass)
	{
		$this->collection = $collection;
		$this->transformer = new $transformerClass;
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

	/**
	 * @param  Request $request
	 * @return  array
	 */
	protected function transformData(Request $request): array
	{
		$items = $this->collection->map(function($model) {
            return $this->transformer->transform($model, $request);
        });

		return $items->toArray();
	}
}
