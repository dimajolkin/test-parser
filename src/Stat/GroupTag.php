<?php

namespace Dimajolkin\TestHtmlParser\Stat;


class GroupTag
{
    public function __construct(
        private string $elementName,
        private int $count,
    ) {}

    public function getCount(): int
    {
        return $this->count;
    }

    public function getDomElementName(): string
    {
        return $this->elementName;
    }
}
