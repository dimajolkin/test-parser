<?php

use Dimajolkin\TestHtmlParser\Content;
use Dimajolkin\TestHtmlParser\Parser;
use Dimajolkin\TestHtmlParser\Stat\GroupCollection;

include __DIR__ . '/../vendor/autoload.php';

$parser = new Parser();
$dom = $parser->parse('http://jsonplaceholder.typicode.com/posts');

$groupCollection = new GroupCollection($dom->getElements());
$report = [];
foreach ($groupCollection as $group) {
    $report[] = sprintf('%s - %s', $group->getDomElementName(), $group->getCount());
}

echo implode(PHP_EOL, $report);
