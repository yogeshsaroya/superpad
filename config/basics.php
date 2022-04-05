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

function getStatus()
{
    return ['1' => 'Active', '2' => 'Inactive'];
}

function getSmAccountType()
{
    return ['Twitter' => 'Twitter', 'Discord' => 'Discord','Medium'=>'Medium','Telegram'=>'Telegram'];
}


function getProjectType()
{
    return [
        'IDO' => 'IDO',
        'Seed Sale' => 'Seed Sale',
        'Private sale' => 'Private sale',
        'NFT Sale' => 'NFT Sale',
        'Land Sale' => 'Land Sale'
    ];
}

function getProjectStatus()
{
    return [
        'Coming Soon' => 'Coming Soon',
        'Whitelist Open' => 'Whitelist Open',
        'Whitelist Closed' => 'Whitelist Closed',
        'Live Now' => 'Live now',
        'Sold Out' => 'Sold Out',
        'TBA' => 'TBA'
    ];
}

function getMenuType()
{
    return ['Help' => 'Help','Company' => 'Company'];
}

function check_date($end_date = DATE ){
    $st = strtotime(DATE);
    $end = strtotime($end_date);
    if($st < $end){ return $end_date; }
    else{ return false; }
}

function getDocType()
{
    return ['National ID' => 'National ID','Driving license' => 'Driving license','Passport'=>'Passport'];
}


function number_format_short( $n ) {
	if ($n >= 0 && $n < 1000) {
		// 1 - 999
		$n_format = floor($n);
		$suffix = '';
	} else if ($n >= 1000 && $n < 1000000) {
		// 1k-999k
		$n_format = floor($n / 1000);
		$suffix = 'K+';
	} else if ($n >= 1000000 && $n < 1000000000) {
		// 1m-999m
		$n_format = floor($n / 1000000);
		$suffix = 'M+';
	} else if ($n >= 1000000000 && $n < 1000000000000) {
		// 1b-999b
		$n_format = floor($n / 1000000000);
		$suffix = 'B+';
	} else if ($n >= 1000000000000) {
		// 1t+
		$n_format = floor($n / 1000000000000);
		$suffix = 'T+';
	}

	return !empty($n_format . $suffix) ? $n_format . $suffix : 0;
}

function getAppStatus(){
    return ['1'=>'In-Progress','2'=>'Lucky','3'=>'Unlucky','4'=>'Allocated'];
}