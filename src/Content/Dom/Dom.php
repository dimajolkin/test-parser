<?php

namespace Dimajolkin\TestHtmlParser\Content\Dom;

use Dimajolkin\TestHtmlParser\Collection\Collection;

class Dom
{
    public function __construct(
        /** @var Collection<int, DomElement>  */
        private Collection $collection
    ) {}

    /**
     * @return Collection<int, DomElement>
     */
    public function getElements(): Collection
    {
        return $this->collection;
    }
}
