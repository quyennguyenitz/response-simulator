<?php
namespace QuyenNguyenItz\Helpers;

class Generator
{
	private $config=[];
	public function __construct()
	{
		// todo code
		$this->setConfig();
	}
	private function setConfig()
	{
		$this->config = config('response-simulator');
		if(empty($this->config))
		{
			$this->config = include __DIR__.'../config/response-simulator.php';
		}
	}
}