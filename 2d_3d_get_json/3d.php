<?php
require_once 'simple_html_dom.php';

$html = file_get_html("https://news.sanook.com/lotto/?fbclid=IwAR0wq12u1sk0MW6l79Gaboyx1bYmhAd96rgPo1XmDproUwXUD0Eq8wmv2ng");

$i = 0;
$articles = [];
$dates = [];
$numbers = [];
$real_numbers = [];

//Get Numbers
foreach ($html->find('p.lotto-check__para--half .lotto__number--three') as $e) {

    array_push($numbers, $e->innertext);


}

foreach ($numbers as $key => $num) {
    if ($key % 2 === 0) {

        array_push($real_numbers, substr($num, 3));
    }
}

//Get Dates
foreach ($html->find('.lotto-check__time') as $e) {

    array_push($dates, explode(" ", $e->datetime)[0]);

}

$results = [];
foreach ($dates as $key => $d) {

    $result = [];
    $result["date"] = $dates[$key];
    $result["3d"] = $real_numbers[$key];

    array_push($results, json_encode($result));

}

echo json_encode($results);


















