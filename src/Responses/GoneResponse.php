<?php

namespace MichielKempen\HttpHelpers\Responses;

use Illuminate\Contracts\Support\Responsable;

class GoneResponse implements Responsable
{
	/**
	 * @var string
	 */
	private $message;

	/**
	 * BadRequestResponse constructor.
	 *
	 * @param string $message
	 */
	public function __construct(string $message = '')
	{
	    $this->message = $message;
	}

	/**
	 * Create an HTTP response that represents the object.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function toResponse($request)
	{
		return response($this->message, 410);
	}
}