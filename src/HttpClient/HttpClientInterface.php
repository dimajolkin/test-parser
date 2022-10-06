<?php

namespace Dimajolkin\TestHtmlParser\HttpClient;

interface HttpClientInterface
{
    public function request(string $uri): Response;
}
