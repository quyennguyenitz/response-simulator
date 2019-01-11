<?php
namespace QuyenNguyenItz;

use QuyenNguyenItz\Exceptions\InvalidConfigException;
use QuyenNguyenItz\Helpers\Binding;

class Simulator
{
	private $bindingFactory;

	private $config=[];
	private $template;
	private $template_result_key;
	private $result;
	private $response_templates;
	private $response_formats;
	private $response_format;
	private $response_structure;
	private $length;

	public function __construct($response_structure,$length=1)
	{
		// todo code
		$this->bindingFactory = new Binding();
		$this->setConfig();
		$this->response_structure = $response_structure;
		$this->length = $length;
	}

	private function setConfig()
	{
		try
		{
			$this->config = config('response-simulator');
		} catch(\Exception $e){}

		if(empty($this->config))
		{
			$this->config = include __DIR__.'/../config/response-simulator.php';
		}

		if(!isset($this->config['response_template']))
		{
			throw new InvalidConfigException('API Response Simulator config invalid : missing response_template config');
		}
		$this->response_templates = $this->config['response_template'];

		$this->template = [];
		if(isset($this->config['default_response_template']))
		{
			$this->template = $this->template = $this->config['response_template'][$this->config['default_response_template']];
		}

		if(!isset($this->config['response_template']['result_key']))
		{
			throw new InvalidConfigException('API Response Simulator config invalid : missing response_template[result_key] config');
		}
		$this->template_result_key = $this->config['response_template']['result_key'];

		$this->response_formats = isset($this->config['response_format']) ? $this->config['response_format'] : [];
		$default_response_format = isset($this->config['default_response_format']) ? $this->config['default_response_format'] : null;
		if($default_response_format && isset($this->response_formats[$default_response_format]))
		{
			$this->response_format = $this->response_formats[$default_response_format];
		}
		else
		{
			$this->response_format = false;
		}
	}

	private function mappingResponseData()
	{
		$result = $this->template;
		$result[$this->template_result_key] = $this->bindingFactory->bindingKeys($this->response_structure,$this->response_format,$this->length);
		$this->result = $result;
	}

	public function template($response_format)
	{
		if(!isset($this->response_formats[$response_format]))
		{
			throw new InvalidConfigException('API Response Simulator config invalid : missing response_format "'.$response_format.'" config');
		}
		$this->response_format = $this->response_formats[$response_format];
	}

	public function response()
	{
		$this->mappingResponseData();
		dd($this->result);
		return response()->json($this->result);
	}
}