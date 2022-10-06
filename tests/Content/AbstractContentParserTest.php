<?php

namespace Dimajolkin\TestHtmlParser\Tests\Content;

use Dimajolkin\TestHtmlParser\Collection\ObjectCollection;
use Dimajolkin\TestHtmlParser\Content\ContentParserInterface;
use Dimajolkin\TestHtmlParser\Content\Dom\DomElement;
use PHPUnit\Framework\TestCase;

abstract class AbstractContentParserTest extends TestCase
{
    protected function testContentParser(ContentParserInterface $parser, string $content, $elementNames): void
    {
        $dom = $parser->parse($content);
        $this->assertCount(count($elementNames), $dom->getElements());
        $this->assertEquals(
            new ObjectCollection(array_map(fn (string $tag) => new DomElement($tag), $elementNames)),
            $dom->getElements()
        );
    }
}
