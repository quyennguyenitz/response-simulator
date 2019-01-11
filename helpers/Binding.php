<?php
namespace QuyenNguyenItz\Helpers;

class Binding
{
	public function __construct()
	{

	}

	public function bindingKeys($response_structure,$response_format,$length=1)
	{
		dd($response_format);
		$result = [];
		$response_data = null;

		if(!empty($response_format))
		{
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

			$data_key = $response_format['data_key'];
			$data_template = $this->bindingFormatData($result[$data_key],$length);
			$result[$data_key] = $data_template;
		}
		else
		{
			$result = $this->bindingFormatData($response_structure,$length);
		}

		return $result;
	}

	private function bindingFormatData($template,$length)
	{
		$result = null;
		for( $i = 0; $i < $length; $i++ )
		{
			$item_data = null;
			foreach($template as $key => $value)
			{
				$item_data[$key] = $this->getItemValue($value);
			}

			if(!empty($item_data))
			{
				$result[] = $item_data;
			}
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
			if( isset(DataType::DATA_RULES[$value_analyzed]) )
			{
				$data_type = $value_analyzed;
				continue;
			}

			$value_analyzed = explode(':',$value_analyzed);
			if( count($value_analyzed) >= 2 )
			{
				$condition_key = $value_analyzed[0];
				if( $condition_key == 'in' ) {
					$conditions[$condition_key] = explode(',', $value_analyzed[1]);
				} elseif($condition_key == 'format'){
					unset($value_analyzed[0]);
					$conditions[$condition_key] = implode(':',$value_analyzed);
				} else {
					$conditions[$condition_key] = $value_analyzed[1];
				}
			}
		}

		$result = DataType::getValue($data_type,$conditions);

		return $result;
	}
}