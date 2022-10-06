<?php

namespace Dimajolkin\TestHtmlParser\Content\Json;

use Dimajolkin\TestHtmlParser\Collection\ObjectCollection;
use Dimajolkin\TestHtmlParser\Content\AbstractContentParser;
use Dimajolkin\TestHtmlParser\Content\Dom\Dom;
use Dimajolkin\TestHtmlParser\Content\Dom\DomElement;

class JsonContentParser extends AbstractContentParser
{
    public function support(string $contentType): bool
    {
        return str_contains($contentType, 'application/json');
    }

    /**
     * @param  ObjectCollection<DomElement>  $collection
     * @param mixed $data
     */
    private function parseKeys(ObjectCollection $collection, mixed $data): void
    {
        if (is_array($data)) {
            /**
             * @var array-key|string|array $value
             */
            foreach ($data as $key => $value) {
                if (is_string($key)) {
                    $collection->add(new DomElement($key));
                }
                if (is_array($value)) {
                    $this->parseKeys($collection, $value);
                }
            }
        }
    }

    public function parse(string $resource): Dom
    {
        /** @var ObjectCollection<DomElement> */
        $elements = new ObjectCollection();
        /** @var mixed $data */
        $data = json_decode($resource, true);
        $this->parseKeys($elements, $data);

        return $this->make($elements);

    }
}
