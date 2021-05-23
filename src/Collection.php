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
                list($entry) = $parameters;

                if (isset($this->map[$entry])) {
                    return $this->map[$entry];
                }

                throw new \Exception("Unknown entry");
            })
            ->setFunction('pushStack', function (...$entries) {
                foreach ($entries as $entry) {
                    $this->map = [
                        $entry,
                        ...$this->map
                    ];
                }
                return $this;
            })
            ->setFunction('pushHeap', function (...$entries) {
                foreach ($entries as $entry) {
                    $this->map = [
                        ...$this->map,
                        $entry
                    ];
                }
                return $this;
            })
            ->setFunction('push', function (...$entries) {
                return $this->pushHeap(...$entries);
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