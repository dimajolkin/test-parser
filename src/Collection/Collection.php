<?php

namespace Dimajolkin\TestHtmlParser\Collection;

use Countable;
use IteratorAggregate;

/**
 * @template TKey of int
 * @template TValue
 * @template-extends IteratorAggregate<TKey, TValue>
 */
interface Collection extends Countable, IteratorAggregate
{
    /**
     * @param  TValue  $element
     */
    public function add(object $element): void;
}
