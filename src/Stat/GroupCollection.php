<?php

namespace Dimajolkin\TestHtmlParser\Stat;

use Dimajolkin\TestHtmlParser\Collection\Collection;
use Dimajolkin\TestHtmlParser\Collection\MapCollection;
use Dimajolkin\TestHtmlParser\Content\Dom\DomElement;
use Traversable;

/**
 * @template T of GroupTag
 * @template-implements Collection<int, GroupTag>
 */
class GroupCollection implements Collection
{
    /** @var MapCollection<DomElement>  */
    private MapCollection $map;

    /**
     * @param  Collection<int, DomElement>  $collection
     */
    public function __construct(Collection $collection)
    {
        /** @var MapCollection<DomElement> $map */
        $map = new MapCollection();
        foreach ($collection as $item) {
            $map->add($item->getName(), $item);
        }
        $this->map = $map;
    }

    public function add(object $element): void
    {
        throw new \Exception('not imp');
    }

    /**
     * @return Traversable<int, GroupTag>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->map->keys() as $itemKey) {
            yield new GroupTag($itemKey, count($this->map->get($itemKey)));
        }
    }

    public function count(): int
    {
        return count($this->map);
    }
}
