<?php
namespace QuyenNguyenItz\Helpers;

class Binding
{
	public function __construct()
	{

	}

	public function bindingKeys($response_format,$response_structure,$length)
	{
		$result = [];
		$response_data = null;

		$data_key = $response_format['data_key'];

		foreach($response_format['template'] as $key=>$value)
		{
			if(is_int($key)) {
				$_key = $value;
				$_val = null;
			} else {
				$_key = $key;
				$_val = $value;
			}

			if(isset($response_structure[$_key]))
			{
				$_val = $response_structure[$key];
			}

			$result[$_key] = $_val;
		}

		$data_template = $this->bindingFormatData($result[$data_key],$length);
		$result[$data_key] = $data_template;

		return $result;
	}

	private function bindingFormatData($template,$length)
	{
		$result = null;
		for( $i = 0; $i < $length; $i++ )
		{
			foreach($template as $key => $value)
			{
				$item_data = null;
				$this->getItemValue($value);
			}
			$result[] = $item_data;
		}

		return $result;
	}

	private function getItemValue($value)
	{
		$result = null;
		$data_type = null;
		$conditions = [];
		$value_analyze = explode('|',$value);
		foreach($value_analyze as $value_analyzed)
		{
			if( isset(DataType::DATA_TYPES[$value_analyzed]) )
			{
				$data_type = $value_analyzed;
				continue;
			}

			$value_analyzed = explode(':',$value_analyzed);
			if( count($value_analyzed) == 2 )
			{
				$conditions[$value_analyzed[0]] = $value_analyzed[1];
			}
		}

		$result = DataType::getValue($data_type,$conditions);

	}
}