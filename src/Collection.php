<?php
declare(strict_types=1);

namespace Ulyssear;


/**
 * Class Collection
 * @package Ulyssear
 */
class Collection extends AbstractCollection
{

    /**
     * Collection constructor.
     * @constructor
     * @param array $map Map of collection
     *
     * Available methods :
     * $collection->get(entry)                      entry is the index of the value
     * $collection->pushStack(...entries)           entries could be one or more entry
     * $collection->pushHeap(...entries)            entries could be one or more entry
     * $collection->push(...entries)                entries could be one or more entry
     * $collection->pushIfNotExists(...entries)     entries could be one or more entry
     * $collection->pop()
     * $collection->shift()
     * $collection->clear()
     * $collection->keys()
     * $collection->values()
     * $collection->entries()
     * $collection->has(value)
     * $collection->hasIndex(value)
     * $collection->flatten()
     */
    public function __construct(array $map = [])
    {
        parent::__construct($map);

        $this
            ->setFunction('get', function ($entry) {
                if (isset($this->map[$entry])) return $this->map[$entry];
                throw new \Exception("Unknown entry");
            })
            ->setFunction('has', function ($value) {
                return in_array($value, array_values($this->map));
            })
            ->setFunction('hasIndex', function ($value) {
                return in_array($value, array_keys($this->map));
            })
            ->setFunction('pushStack', function (...$entries) {
                foreach ($entries as $entry) $this->map = [$entry, ...$this->map];
                return $this;
            })
            ->setFunction('pushHeap', function (...$entries) {
                foreach ($entries as $entry) $this->map = [...$this->map, $entry];
                return $this;
            })
            ->setFunction('push', function (...$entries) {
                $this->map = array_merge_recursive($this->map, $entries);
                return $this;
            })
            ->setFunction('pushNamedItem', function ($key, $value) {
                $this->map[$key] = $value;
                return $this;
            })
            ->setFunction('pushNamedItemIfNotExists', function ($key, $value) {
                if (!$this->hasIndex($key)) $this->pushNamedItem($key,$value);
                return $this;
            })
            ->setFunction('pushNamedItemsIfNotExists', function (...$entries) {
                foreach ($entries as $entry) $this->pushNamedItemIfNotExists(...$entry);
                return $this;
            })
            ->setFunction('pushNamedItems', function (...$entries) {
                foreach ($entries as $entry) $this->pushNamedItem(...$entry);
                return $this;
            })
            ->setFunction('pushIfNotExists', function (...$entries) {
                foreach ($entries as $entry) if (false === in_array($entry, $this->map)) $this->push($entry);
                return $this;
            })
            ->setFunction('pop', function () {
                return array_pop($this->map);
            })
            ->setFunction('shift', function () {
                return array_shift($this->map);
            })
            ->setFunction('clear', function () {
                $this->map = [];
                return $this;
            })
            ->setFunction('keys', function () {
                return array_keys($this->map);
            })
            ->setFunction('values', function () {
                return array_values($this->map);
            })
            ->setFunction('entries', function () {
                return $this->map;
            })
            ->setFunction('count', function () {
                return count(array_values($this->map));
            });
    }

}