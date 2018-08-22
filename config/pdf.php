<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => public_path('temp/'),
    'font_path' => public_path('/fonts/'),
    'font_data' => [
        'Font' => [
            'R'  => 'BTITRBOLD.ttf',    // regular font
            'B'  => 'BTITRBOLD.ttf',       // optional: bold font
            'I'  => 'BTITRBOLD.ttf',     // optional: italic font
            'BI' => 'BTITRBOLD.ttf', // optional: bold-italic font
//            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
//            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ]
    ]
];
