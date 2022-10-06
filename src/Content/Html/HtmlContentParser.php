<?php

namespace Dimajolkin\TestHtmlParser\Content\Html;

use Dimajolkin\TestHtmlParser\Collection\ObjectCollection;
use Dimajolkin\TestHtmlParser\Content\AbstractContentParser;
use Dimajolkin\TestHtmlParser\Content\Dom\Dom;
use Dimajolkin\TestHtmlParser\Content\Dom\DomElement;
use Dimajolkin\TestHtmlParser\HttpClient\Response;

class HtmlContentParser extends AbstractContentParser
{
    public function support(string $contentType): bool
    {
        return str_contains($contentType, 'text/html');
    }

    /**
     * @return \Generator<int, string, mixed, void>
     */
    private function parseTags(string $resource): iterable
    {
        preg_match_all('/\<(?<tag>(\w+))\>/', $resource, $matches, PREG_SET_ORDER);
        foreach ($matches as $item) {
            yield $item['tag'];
        }
    }

    public function parse(string $resource): Dom
    {
        /** @var ObjectCollection<DomElement> */
        $elements = new ObjectCollection();
        foreach ($this->parseTags($resource) as $tagName) {
            $elements->add(new DomElement($tagName));
        }

        return $this->make($elements);
    }
}
