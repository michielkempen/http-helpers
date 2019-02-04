<?php

namespace MichielKempen\LaravelHttpResponses\Transformers;

use Illuminate\Http\Request;

interface Transformer
{
	/**
	 * @param $model
	 * @param Request|null $request
	 * @return array
	 */
	public function transform($model, Request $request = null) : array;
}