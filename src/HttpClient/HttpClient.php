<?php

namespace Dimajolkin\TestHtmlParser\HttpClient;

class HttpClient implements HttpClientInterface
{
    public function request(string $uri): Response
    {
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = (string) curl_exec($ch);

        return new Response(
            HttpCodeEnum::SUCCESS,
            $response,
            [
                HeaderNameEnum::CONTENT_TYPE->name => (string) curl_getinfo($ch, CURLINFO_CONTENT_TYPE),
            ]
        );
    }
}
