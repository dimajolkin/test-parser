<?php

namespace Dimajolkin\TestHtmlParser\Content;

use Dimajolkin\TestHtmlParser\Collection\ObjectCollection;
use Dimajolkin\TestHtmlParser\Content\Dom\Dom;

class ContentParser implements ContentParserInterface
{
    private ?ContentParserInterface $supportParser = null;

    public function __construct(
        /** @var array<ContentParserInterface> $parsers */
        private array $parsers,
    ) {}

    public function support(string $contentType): bool
    {
        foreach ($this->parsers as $parser) {
            if ($parser->support($contentType)) {
                $this->supportParser = $parser;
                return true;
            }
        }

        return false;
    }

    public function parse(string $resource): Dom
    {
        return $this->supportParser?->parse($resource) ?? throw new \Exception();
    }
}
