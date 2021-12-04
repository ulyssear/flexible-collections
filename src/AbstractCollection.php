<?php
declare(strict_types=1);

namespace Ulyssear;

/**
 * Class AbstractCollection
 * @package Ulyssear
 */
abstract class AbstractCollection
{

    /**
     * @var array Map of collection
     */
    public array $map;

    /**
     * @var array Map of collection's functions
     */
    private array $functions = [];

    /**
     * AbstractCollection constructor.
     * @constructor
     * @param array $map
     */
    public function __construct(array $map = [])
    {
        $this->map = $map;
    }

    /**
     * @param string $method Method's name
     * @param array $parameters Method's parameters
     * @return mixed Method's result
     * @throws \Exception Exception thrown
     */
    public function __call(string $method, array $parameters)
    {
        if (in_array($method, array_keys($this->functions))) {
            try {
                return $this->functions[$method](...$parameters);
            } catch (\Throwable $throwable) {
                throw new \Exception("Error with method \"$method\"");
            }
        }

        try {
            return $this[$method](...$parameters);
        } catch (\Throwable $throwable) {
            throw new \Exception("No function named \"$method\" defined for collections !");
        }
    }

    /**
     * Sets function for the collection
     * @param string $name Method's name
     * @param callable $function Method's callback
     * @return $this Current instance
     */
    public function setFunction(string $name, callable $function)
    {
        $this->functions[$name] = $function;
        return $this;
    }
}