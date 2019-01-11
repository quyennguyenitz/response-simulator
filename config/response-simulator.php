<?php
return [
	'title' => 'API Response Simulator',

	'default_response_template' => 'template',
	'response_template' => [
		// define response template for all API's response
		'template' => [
			'_type' => 'success',
			'_time' => date('Y-m-d H:i:s'),
			'status' => true,
			'result' => []
		],
		// define key which hold result
		'result_key' => 'result'
	],

	//'default_response_format' => 'list',
	'default_response_format' => false,
	'response_format' => [
		'list' => [
			// define response template for get list response
			'template' => [
				'length' => 10,
				'page' => 1,
				'total_page' => 2,
				'total_record' => 15,
				'rows' => []
			],
			// define key which hold result
			'data_key' => 'rows'
		]
	]
];