<?php
namespace QuyenNguyenItz\Exceptions;

use Exception;

class InvalidConfigException extends Exception
{
	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 * @return \Illuminate\Http\Response
	 */
	public function render($request)
	{
	}
}