<?php

namespace Dimajolkin\TestHtmlParser\Tests;

use Dimajolkin\TestHtmlParser\Exception\EmptyContentException;
use Dimajolkin\TestHtmlParser\Exception\ResourceNotAllowedException;
use Dimajolkin\TestHtmlParser\HttpClient\HeaderNameEnum;
use Dimajolkin\TestHtmlParser\HttpClient\HttpClient;
use Dimajolkin\TestHtmlParser\HttpClient\HttpCodeEnum;
use Dimajolkin\TestHtmlParser\HttpClient\Response;
use Dimajolkin\TestHtmlParser\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    private function makeParser(Response $response): Parser
    {
        $client = $this->createStub(HttpClient::class);
        $client
            ->method('request')
            ->willReturn($response)
        ;

        return new Parser($client);
    }

    public function testParseResourceNotAllowedException(): void
    {
        $this->expectException(ResourceNotAllowedException::class);
        $parser = $this->makeParser(new Response(HttpCodeEnum::ERROR));

        $parser->parse('http://example.ru');
    }

    public function testParseEmptyContentException(): void
    {
        $this->expectException(EmptyContentException::class);
        $parser = $this->makeParser(new Response(HttpCodeEnum::SUCCESS, null));
        $parser->parse('http://example.ru');
    }

    public function testParse(): void
    {
        $parser = $this->makeParser(new Response(HttpCodeEnum::SUCCESS, '<html></html>', [
            HeaderNameEnum::CONTENT_TYPE->name => 'text/html',
        ]));
        $dom = $parser->parse('http://example.com');
        $this->assertCount(1, $dom->getElements());
    }
}
