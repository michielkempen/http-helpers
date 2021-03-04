<?php

namespace MichielKempen\LaravelHttpResponses\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContentResponse implements Responsable
{
	protected $content;

	public function __construct($content)
	{
		$this->content = $content;
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
			'data' => $this->content,
		]);
	}
}
