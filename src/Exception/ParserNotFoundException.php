<?php

namespace Dimajolkin\TestHtmlParser\Exception;

class ParserNotFoundException extends ParserException
{
    public function __construct(string $contentType)
    {
        parent::__construct("Parser for $contentType not found");
    }
}
