<?php

namespace Dimajolkin\TestHtmlParser\Collection;

use Psalm\Type\Atomic\TKeyedArray;
use Traversable;

/**
 * @template TValue of object
 * @template-implements Collection<int, TValue>
 */
class ObjectCollection implements Collection
{
    /** @var array<int, TValue> */
    private array $data;

    /**
     * @param array<int, TValue>  $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @param  TValue  $element
     */
    public function add(object $element): void
    {
        $this->data[] = $element;
    }

    public function count(): int
    {
        return count($this->data);
    }

    /**
     * @return Traversable<int, TValue>
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->data);
    }
}
