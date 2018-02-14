<?php

namespace MichielKempen\HttpHelpers\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use MichielKempen\HttpHelpers\Transformers\Transformer;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class CollectionResponse implements Responsable
{
	/**
	 * @var Collection
	 */
	private $collection;

	/**
	 * @var Transformer
	 */
	private $transformer;

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
        $items = $this->collection->map(function($model) {
            return $this->transformer->transform($model);
        });

		return new JsonResponse([
			'data' => $items->toArray()
		]);
	}
}