<?php
/*
  *  3. Write a function that calculates a passed array’s depth.
  */


/*
  *  Check how depth is the array
  */
function get_array_depth($arr) {
    $depth = 1;
    foreach ($arr as $val) {
        if (is_array($val)) {
            $d = get_array_depth($val) + 1;
            if ($d > $depth) {
                $depth = $d;
            }
        }
    }
    return $depth;
}

// some array with multiple nested arrays
$sampleArray = 
[
    [
        'depth3' => [
            3,
            3
        ],
        [
            3,
            [
                4,
                [
                    5,
                    5 => '[fake array]'
                ]
            ]
        ]
    ], 
    'depth2' => [
        [
            3,
            & $sampleArray['depth2']
        ],
        [
            3,
            [
                'depth4' => 'text'
            ]
        ]
    ]
];

// call function and echo the result
echo get_array_depth($sampleArray);