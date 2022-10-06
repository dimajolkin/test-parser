<?php

namespace Dimajolkin\TestHtmlParser\Content;

use Dimajolkin\TestHtmlParser\Content\Dom\Dom;


interface ContentParserInterface
{
    public function support(string $contentType): bool;

    public function parse(string $resource): Dom;
}
