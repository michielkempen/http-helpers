<?php

namespace MichielKempen\HttpHelpers\Responses;

use MichielKempen\HttpHelpers\Transformers\Transformer;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemResponse implements Responsable
{
	/**
	 * @var mixed
	 */
	private $model;

	/**
	 * @var Transformer
	 */
	private $transformer;

	/**
	 * PaginatedResponse constructor.
	 *
	 * @param $model
	 * @param string $transformerClass
	 */
	public function __construct($model, string $transformerClass)
	{
		$this->model = $model;
		$this->transformer = app($transformerClass);
	}

	/**
	 * Create an HTTP response that represents the object.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function toResponse($request)
	{
		return response()->json([
			'data' => $this->transformer->transform($this->model)
		]);
	}
}