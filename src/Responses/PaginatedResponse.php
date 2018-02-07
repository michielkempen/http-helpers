<?php

namespace MichielKempen\HttpHelpers\Responses;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Responsable;
use MichielKempen\HttpHelpers\Transformers\Transformer;

class PaginatedResponse implements Responsable
{
	/**
	 * @var LengthAwarePaginator
	 */
	private $paginator;

	/**
	 * @var Transformer
	 */
	private $transformer;

	/**
	 * PaginatedResponse constructor.
	 *
	 * @param LengthAwarePaginator $paginator
	 * @param string $transformerClass
	 */
	public function __construct(LengthAwarePaginator $paginator, string $transformerClass)
	{
		$this->paginator = $paginator;
		$this->transformer = app($transformerClass);
	}

	/**
	 * Create an HTTP response that represents the object.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function toResponse($request)
	{
		$items = collect($this->paginator->items())->map(function($model) {
			return $this->transformer->transform($model);
		});

		return response()->json([
			'data' => $items->toArray(),
			'meta' => [
				'pagination' => [
					'total' => $this->paginator->total(),
					'per_page' => $this->paginator->perPage(),
					'current_page' => $this->paginator->currentPage(),
					'total_pages' => $this->paginator->lastPage()
				]
			]
		]);
	}
}