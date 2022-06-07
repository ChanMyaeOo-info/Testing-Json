<?php
require_once 'simple_html_dom.php';

$html = file_get_html('https://classic.set.or.th/mkt/sectorialindices.do?language=en&country=US');

$i = 0;
$mArray = [];
foreach ($html->find('td') as $e) {

    array_push($mArray,$e->innertext);

    $i++;
    if ($i>7){
        break;
    }

}

$set = str_split($mArray[1]);
$value = str_split($mArray[7]);
$point_position = strpos($mArray[7],'.');

$result = [];
$result["RESULT"] = $set[count($set)-1].''.$value[$point_position-1];
$result["SET"] = $mArray[1];
$result["VALUE"] = $mArray[7];

echo json_encode($result);



?>















