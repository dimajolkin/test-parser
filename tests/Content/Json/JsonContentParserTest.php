<?php

namespace Dimajolkin\TestHtmlParser\Tests\Content\Json;

use Dimajolkin\TestHtmlParser\Content\Json\JsonContentParser;
use Dimajolkin\TestHtmlParser\Tests\Content\AbstractContentParserTest;

class JsonContentParserTest extends AbstractContentParserTest
{
    public function providerParse(): array
    {
        return [
            ['{"html": 12}', ['html']],
            ['{"key": 1, "key2": 2}', ['key', 'key2']],
            ['{"key": 1, "key2": 2, "key3": {"key4": 4}}', ['key', 'key2', 'key3', 'key4']],
        ];
    }

    /**
     * @dataProvider providerParse
     */
    public function testParse(string $content, array $tagNames): void
    {
        $parser = new JsonContentParser();
        $this->testContentParser($parser, $content, $tagNames);
    }
}
