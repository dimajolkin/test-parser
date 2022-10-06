<?php

namespace Dimajolkin\TestHtmlParser\Collection;

/**
 * @template T
 */
class MapCollection implements \Countable
{
    /** @var array<string, array<T>>  */
    private array $data = [];

    /**
     * @param  string  $key
     * @param  T  $value
     */
    public function add(string $key, object $value): void
    {
        $this->data[$key][] = $value;
    }

    /**
     * @return array<T>
     */
    public function get(string $key): array
    {
        return $this->data[$key] ?? [];
    }

    /**
     * @return list<string>
     */
    public function keys(): array
    {
        return array_keys($this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }
}
