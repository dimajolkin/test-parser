<?php

namespace Dimajolkin\TestHtmlParser\Tests\Content\Html;

use Dimajolkin\TestHtmlParser\Content\Html\HtmlContentParser;
use Dimajolkin\TestHtmlParser\Tests\Content\AbstractContentParserTest;

class HtmlContentParserTest extends AbstractContentParserTest
{
    public function providerParse(): array
    {
        return [
           ['<html>', ['html']],
           ['<html><p>', ['html', 'p']],
           ['<html><p><tag></tag></p><html/>', ['html', 'p', 'tag']],
        ];
    }

    /**
     * @dataProvider providerParse
     */
    public function testParse(string $content, array $tagNames): void
    {
        $parser = new HtmlContentParser();
        $this->testContentParser($parser, $content, $tagNames);
    }
}
