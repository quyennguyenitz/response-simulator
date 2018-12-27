<?php
namespace QuyenNguyenItz\Helpers;

class DataType
{
	const DATA_TYPES = [
		'integer' => ['min','max'],
		'string' => ['min','max','in'],
		'date' => [],
		'datetime' => []
	];
}