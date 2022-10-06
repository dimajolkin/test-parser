<?php

namespace Dimajolkin\TestHtmlParser\HttpClient;

class Response
{
    public function __construct(
        private HttpCodeEnum $code,
        private ?string $body = null,
        /** @var array<string, string> */
        private array $headers = [],
    ) {}

    public function getHeader(HeaderNameEnum $name): ?string
    {
        return $this->headers[$name->name] ?? null;
    }

    public function getCode(): HttpCodeEnum
    {
        return $this->code;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }
}
