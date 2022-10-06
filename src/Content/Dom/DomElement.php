<?php

namespace Dimajolkin\TestHtmlParser\Content\Dom;

class DomElement
{
    public function __construct(
        private string $name,
        private ?string $content = null,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }
}
