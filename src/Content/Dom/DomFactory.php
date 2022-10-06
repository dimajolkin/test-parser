<?php

namespace Dimajolkin\TestHtmlParser\Content\Dom;

use Dimajolkin\TestHtmlParser\Collection\Collection;

class DomFactory
{
    /**
     * @param  Collection<int, DomElement>  $elements
     */
    public function make(Collection $elements): Dom
    {
        return new Dom($elements);
    }
}
