<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class ItemResponse implements Responsable
{
	protected $model;
	protected $transformer;

	public function __construct($model, string $transformerClass)
	{
		$this->model = $model;
		$this->transformer = new $transformerClass;
	}

    public static function new($model, string $transformerClass): self
    {
        return new static($model, $transformerClass);
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
			'data' => $this->transformer->transform($this->model, $request),
		]);
	}
}
