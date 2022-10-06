<?php

namespace Dimajolkin\TestHtmlParser\Content;

use Dimajolkin\TestHtmlParser\Collection\Collection;
use Dimajolkin\TestHtmlParser\Content\Dom\Dom;
use Dimajolkin\TestHtmlParser\Content\Dom\DomElement;
use Dimajolkin\TestHtmlParser\Content\Dom\DomFactory;

abstract class AbstractContentParser implements ContentParserInterface
{
    public function __construct(
        private DomFactory $domFactory = new DomFactory(),
    ) {}

    /**
     * @param Collection<int, DomElement>  $collection
     */
    protected function make(Collection $collection): Dom
    {
        return $this->domFactory->make($collection);
    }
}
