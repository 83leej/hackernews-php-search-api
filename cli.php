<?php

include 'HackerNewsSearch.php';

$hnsearch = new HackerNewsSearch();

$hnsearch->vector = $argv[1];

$hnsearch->query = $argv[2];

if(isset($argv[3]))
    $hnsearch->tags = $argv[3];

if(isset($argv[4]))
    $hnsearch->numericFilters = $argv[4];


var_dump($hnsearch->search());

foreach($hnsearch->results['hits'] as $res){

    echo $res['title'] .' - '. $res['author'].' - '. $res['url'].' - '. $res['points'] ."\r\n";

}

echo "total of {$hnsearch->results['nbHits']} results found for {$hnsearch->results['query']}";
