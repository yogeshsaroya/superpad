<?php
/* print array and string */
function ec($str = null, $txt = null)
{
    if (!is_null($str)) {
        if (is_array($str) || is_object($str)) {
            echo $txt . " ";
            if (is_array($str)) {
                echo count($str);
            }
            echo "<pre>";
            print_r($str);
            echo "</pre>";
        } else {
            echo "$txt <br>$str<br>";
        }
    } else {
        echo "$txt <br>Empty/Null<br>";
    }
}

function num_2($num, $limit = 2)
{
    return number_format((float) $num, $limit, '.', '');
}

function cu($num, $limit = 2)
{
    return number_format((float) $num, $limit);
}

function num($num = null)
{
    if ($num == 0) {
        return 0;
    } else {
        return (int) $num;
    }
}

function show_image($full_path = null, $w = 100, $h = 100, $dimensions = 'ff', $clean_url = 1, $formate = 'jpg')
{
    $img_url = null;
    if (!empty($full_path) && file_exists($full_path)) {
        if ($clean_url == 1) {
            $img_url = SITEURL . "images/" . $w . "_" . $h . "_" . $dimensions . "_" . $formate . "/" . $full_path;
        } else {
            $img_url = SITEURL . "imgd.php?w=$w&h=$h&no-cache&skip-original&$dimensions=ffffff7f&sa=$formate&src=$full_path&ver=" . rand(123456, 987654);
        }
    }
    if (empty($img_url)) {
        if ($clean_url == 1) {
            $img_url = SITEURL . "images/" . $w . "_" . $h . "_ff_png/img/placeholder.png";
        } else {
            $img_url = SITEURL . "imgd.php?w=$w&h=$h&no-cache&skip-original&$dimensions=ffffff7f&sa=png&src=img/placeholder.png&ver=" . rand(123456, 987654);
        }
    }
    return $img_url;
}

/**
 * check give string is date or not
 *
 * @call validateDate($str,$format = 'Y-m-d H:i:s');
 *
 */
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function uc_text($str = null)
{
    return ucwords(strtolower(trim($str)));
}

function set_version($t = null)
{
    if ($t == 'c') {
        return '.css?v=' . rand(111, 999999);
    } elseif ($t == 'j') {
        return '.js?v=' . rand(111, 999999);
    }
}

function set_tooltip($pos = 'top', $title = null)
{
    return '<i class="fa fa-question-circle" data-animation="false" data-toggle="tooltip" data-html="true" data-placement="' . $pos . '" title="' . $title . '"></i>';
}

function blog_type()
{
    return ['1' => 'Immigration', '2' => 'Property'];
}

function getPropertyType()
{
    return ['1' => 'Sell', '2' => 'Rent'];
}

function getLocations()
{
    return [
        'Bangkok' => ['City Centre - Bangkok' => 'City Centre', 'City Fringe - Bangkok' => 'City Fringe', 'Suburbs - Bangkok' => 'Suburbs'],
        'Chiang Mai' => ['City Centre - Chiang Mai' => 'City Centre', 'City Fringe - Chiang Mai' => 'City Fringe', 'Suburbs - Chiang Mai' => 'Suburbs'],
        'Hua Hin' => ['City Centre - Hua Hin' => 'City Centre', 'City Fringe - Hua Hin' => 'City Fringe', 'Suburbs - Hua Hin' => 'Suburbs'],
        'Pattaya' => ['City Centre - Hua Hin' => 'City Centre', 'City Fringe - Hua Hin' => 'City Fringe', 'Suburbs - Hua Hin' => 'Suburbs'],
    ];
}

function getNum($st = 1, $end = 10)
{
    $arr = [];
    for ($i = $st; $i <= $end; $i++) {
        $arr[$i] = $i;
    }
    return $arr;
}

function YesOrNo()
{
    return ['1' => 'Yes', '2' => 'No'];
}

function property_type()
{
    return [
        'Commercial' => ['Commercial' => 'Commercial'],
        'Residential' => [
            'Condo' => 'Condo',
            'Detached House' => 'Detached House',
            'Townhouse' => 'Townhouse',
            'Land' => 'Land',
            'Apartment' => 'Apartment'
        ]
    ];
}

function furnishing()
{
    return ['Unfurnished' => 'Unfurnished', 'Partially Furnished' => 'Partially Furnished', 'Fully Furnished' => 'Fully Furnished'];
}

function tenure()
{
    return [
        'Freehold' => 'Freehold',
        'Leasehold' => 'Leasehold',
        '30-year Leasehold' => '30-year Leasehold',
        '60-year Leasehold' => '60-year Leasehold',
        '90-year Leasehold' => '90-year Leasehold',
        '99-year Leasehold' => '99-year Leasehold'
    ];
}

function phone_mask($str = null){
    return str_pad(substr($str, -7), strlen($str), '*', STR_PAD_RIGHT);
}

function emal_mask($str = null){
    return str_pad(substr($str, 4), strlen($str), '*', STR_PAD_LEFT);
}