<?php
namespace QuyenNguyenItz\Helpers;

class DataType
{
	const DATA_RULES = [
		'code' => ['prefix','content'],
		'integer' => ['length','in'],
		'string' => ['min','max','in'],
		'date' => [],
		'datetime' => []
	];

	private static $numbers = [1,2,3,4,5,6,7,8,9,0];
	private static $chars = [
		'Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G',
		'H','J','K','L','Z','X','C','V','B','N','M'];

	public static function getValue($data_type,$conditions)
	{
		switch($data_type)
		{
			case 'integer':
				$val = self::getIntegerValue($conditions);
				break;
			case 'string':
				$val = self::getStringValue($conditions);
				break;
			case 'code':
				$val = self::getCodeValue($conditions);
				break;
			case 'date':
			case 'datetime':
				$val = self::getDatetimeValue($conditions,$data_type);
				break;
			default:
				$val = null;
				break;
		}

		return $val;
	}

	private static function getRandomValueFromArray($data)
	{
		$values = array_random($data, 1);
		return $values[0];
	}

	private static function getIntegerValue($conditions)
	{
		if(isset($conditions['in']) && !empty($conditions['in']))
		{
			$val = self::getRandomValueFromArray($conditions['in']);
		}
		else
		{
			$min = 1;
			$max = 100;

			if(isset($conditions['range']))
			{
				$range = explode(',', $conditions['range']);
				if( count($range) == 2 && is_numeric($range[0]) && is_numeric($range[1]) && $range[0] <= $range[1])
				{
					$min = intval($range[0]);
					$max = intval($range[1]);
				}
			}

			$val = rand($min,$max);
		}

		return $val;
	}

	private static function getStringValue($conditions)
	{
		$val = null;
		if(isset($conditions['in']) && !empty($conditions['in']))
		{
			$val = self::getRandomValueFromArray($conditions['in']);
		}
		else
		{
			$length = array_get($conditions,'length', 12);
			$length = $length > 100 ? 100 : $length;
			$cnt = 0;
			for( $i = 0; $i < $length; $i++ )
			{
				if( $cnt == 4 )
				{
					$val .= ' ';
					$cnt = 0;
				}

				$val .= self::getRandomValueFromArray(self::$chars);
				$cnt++;
			}
		}

		return $val;
	}

	private static function getCodeValue($conditions)
	{
		$prefix = null;
		if(isset($conditions['prefix']) && !empty($conditions['prefix']))
		{
			$prefix = $conditions['prefix'];
		}

		$suffix = null;
		if(isset($conditions['suffix']) && !empty($conditions['suffix']))
		{
			$suffix = $conditions['suffix'];
		}

		$content = array_get($conditions,'content');
		$content = self::getRandomCode($content);

		return $prefix.$content.$suffix;
	}

	private static function getRandomCode($content)
	{
		$content = explode(',',$content);

		$rule = 'integer';
		$len = 5;
		if(count($content) == 1) {
			if(in_array($content[0], ['integer','string'])) {
				$rule = $content[0];
			}
		} elseif(count($content) == 2){
			if(in_array($content[0], ['integer','string'])) {
				$rule = $content[0];
			}

			if(is_numeric($content[1]))
			{
				$len = $content[1] > 20 ? 20 : $content[1];
			}
		}

		if($rule == 'string')
		{
			$refs = self::$chars;
		}
		else
		{
			$refs = self::$numbers;
		}

		$result = null;
		for( $i = 0; $i < $len; $i++ )
		{
			$result .= self::getRandomValueFromArray($refs);
		}

		return $result;
	}

	private static function getDatetimeValue($conditions,$data_type)
	{

	}

}