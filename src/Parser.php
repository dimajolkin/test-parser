<?php

namespace Dimajolkin\TestHtmlParser;

use Dimajolkin\TestHtmlParser\Collection\ObjectCollection;
use Dimajolkin\TestHtmlParser\Content\ContentParser;
use Dimajolkin\TestHtmlParser\Content\Json\JsonContentParser;
use Dimajolkin\TestHtmlParser\Exception\ContentTypeNotFoundException;
use Dimajolkin\TestHtmlParser\Exception\EmptyContentException;
use Dimajolkin\TestHtmlParser\Exception\ParserException;
use Dimajolkin\TestHtmlParser\Exception\ParserNotFoundException;
use Dimajolkin\TestHtmlParser\Exception\ResourceNotAllowedException;
use Dimajolkin\TestHtmlParser\HttpClient\HeaderNameEnum;
use Dimajolkin\TestHtmlParser\HttpClient\HttpClient;
use Dimajolkin\TestHtmlParser\HttpClient\HttpCodeEnum;
use Dimajolkin\TestHtmlParser\Content\Dom\Dom;
use Dimajolkin\TestHtmlParser\Content\Html\HtmlContentParser;
use Dimajolkin\TestHtmlParser\Content\ContentParserInterface;

class Parser
{
    public function __construct(
        private HttpClient $client = new HttpClient(),
        private ContentParserInterface $parser = new ContentParser([
            new HtmlContentParser(),
            new JsonContentParser(),
        ]),
    ) { }

    /**
     * @throws ParserException
     */
    public function parse(string $uri): Dom
    {
        $response = $this->client->request($uri);
        if ($response->getCode() !== HttpCodeEnum::SUCCESS) {
            throw new ResourceNotAllowedException();
        }

        $content = $response->getBody();
        if (!$content) {
            throw new EmptyContentException();
        }

        $contentType = $response->getHeader(HeaderNameEnum::CONTENT_TYPE) ?? throw new ContentTypeNotFoundException();
        if (!$this->parser->support($contentType)) {
            throw new ParserNotFoundException($contentType);
        }

        return $this->parser->parse($content);
    }
}
