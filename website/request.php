<?php
//Made by SamzyDev
include('simple_html_dom.php');
$html = file_get_html("https://www.dnr.state.mn.us/hunting/seasons.html");
foreach($html->find('tr.event') as $article) {
    $item['title'] = $article->find('td.event-title', 0)->plaintext;
    $item['date']  = $article->find('td.event-date', 0)->plaintext; //
    $item['link']  =  $article->find('td.event-title', 0)->find('a', 0)->href;
    $articles[] = $item;
}
$json = json_encode($articles);
print_r($json);
?>