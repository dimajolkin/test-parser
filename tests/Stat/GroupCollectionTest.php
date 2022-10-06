<?php

namespace Dimajolkin\TestHtmlParser\Tests\Stat;

use Dimajolkin\TestHtmlParser\HttpClient\HeaderNameEnum;
use Dimajolkin\TestHtmlParser\HttpClient\HttpClient;
use Dimajolkin\TestHtmlParser\HttpClient\HttpCodeEnum;
use Dimajolkin\TestHtmlParser\HttpClient\Response;
use Dimajolkin\TestHtmlParser\Parser;
use Dimajolkin\TestHtmlParser\Stat\GroupCollection;
use PHPUnit\Framework\TestCase;

class GroupCollectionTest extends TestCase
{
    public function providerGroup(): array
    {
        return [
            [
                '<html><tag><p></p><p></p></tag></html>',
                [
                    'html' => 1,
                    'tag' => 1,
                    'p' => 2,
                ]
            ],
        ];
    }

    /**
     * @dataProvider providerGroup
     */
    public function testGroup(string $content, array $expectedReport): void
    {
        $response = new Response(HttpCodeEnum::SUCCESS, $content, [HeaderNameEnum::CONTENT_TYPE->name => 'text/html']);
        $client = $this->createStub(HttpClient::class);
        $client
            ->method('request')
            ->willReturn($response)
        ;

        $parser = new Parser(client: $client);
        $dom = $parser->parse('https://example.com/');

        $groupCollection = new GroupCollection($dom->getElements());
        $report = [];
        foreach ($groupCollection as $group) {
            $report[$group->getDomElementName()] = $group->getCount();
        }
        $this->assertEquals($expectedReport, $report);
    }
}
