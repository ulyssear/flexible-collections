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
     */
    public function __construct(array $map = [])
    {
        parent::__construct($map);

        $this
            ->setFunction('get', function (...$parameters) {
                $entry = $parameters[0];

                if (isset($this->map[$entry])) {
                    return $this->map[$entry];
                }

                throw new \Exception("Unknown entry");
            })
            ->setFunction('pushStack', function (...$entries) {
                $this->map = [...$entries, ...$this->map];
            })
            ->setFunction('pushHeap', function (...$entries) {
                $this->map = [...$this->map, ...$entries];
            })
            ->setFunction('push', function (...$entries) {
                $this->pushHeap(...$entries);
            })
            ->setFunction('pushIfNotExists', function (...$entries) {
                foreach ($entries as $entry) {
                    if (false === in_array($entry, $this->map)) {
                        $this->push($entry);
                    }
                }

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
                return array_values($this->map);
            });
    }

}