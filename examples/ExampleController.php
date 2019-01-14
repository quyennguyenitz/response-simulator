<?php
namespace QuyenNguyenItz\Examples;

require_once __DIR__.'/../vendor/autoload.php';

class ExampleController
{
	public function getList()
	{
		$structure = [
			'id' => 'integer|range:1,100',
			'cd' => 'code|prefix:ORD-|content:integer,10',
			'code' => 'code|prefix:ORD-|content:string,10|suffix:-ONL',
			'name' => 'string|length:10',
			'des' => 'string',
			'status' => 'string|in:New,Approved,Rejected',
			'created_at' => 'date|format:m-d-Y|min:2018-01-01|max:2018-03-31',
			'updated_at' => 'date|format:m-d-Y H:i:s|min:2018-01-01|max:2018-03-31',
			'ac' => 'integer|in:0,1'
		];

		$template = [
			'length' => 10,
			'page' => 2,
			'total_page' => 5,
			'total_record' => 45
		];

		$simulator = new \QuyenNguyenItz\Simulator();

		// response list of object
		$response = $simulator
			->template('list', $template)
			->structure($structure)
			->response();

		return $response;
	}

	public function getDetail($id)
	{
		$structure = [
			'id' => 'integer|value:'.$id,
			'cd' => 'code|prefix:ORD-|content:integer,10',
			'code' => 'code|prefix:ORD-|content:string,10|suffix:-ONL',
			'name' => 'string|length:10',
			'des' => 'string',
			'status' => 'string|in:New,Approved,Rejected',
			'created_at' => 'date|format:m-d-Y|min:2018-01-01|max:2018-03-31',
			'updated_at' => 'date|format:m-d-Y H:i:s|min:2018-01-01|max:2018-03-31',
			'ac' => 'integer|in:0,1'
		];

		$simulator = new \QuyenNguyenItz\Simulator();

		// response single of object
		$response = $simulator
			->structure($structure)
			->single();

		return $response;
	}
}