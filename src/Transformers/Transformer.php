<?php

namespace MichielKempen\LaravelHttpResponses\Transformers;

use Illuminate\Http\Request;

interface Transformer
{
	/**
	 * @param  Request $request
	 * @param $model
	 * @return array
	 */
	public function transform(Request $request, $model) : array;
}