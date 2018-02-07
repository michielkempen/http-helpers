<?php

namespace MichielKempen\HttpHelpers\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContentResponse implements Responsable
{
	/**
	 * @var mixed
	 */
	private $content;

	/**
	 * ContentResponse constructor.
	 *
	 * @param $content
	 */
	public function __construct($content)
	{
		$this->content = $content;
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
			'data' => $this->content
		]);
	}
}