<?php
declare(strict_types=1);

namespace Ulyssear;

abstract class AbstractCollection
{

    public array $map;

    private array $functions = [];

    public function __construct(array $map = [])
    {
        $this->map = $map;
    }

    public function __call(string $method, array $parameters)
    {
        if (in_array($method, array_keys($this->functions))) {
            try {
                return $this->call($method, ...$parameters);
            } catch (\Throwable $throwable) {
                throw new \Exception($throwable);
            }
        }

        return $this;
    }

    public function setFunction(string $name, callable $function)
    {
        $this->functions[$name] = $function;
        return $this;
    }

    public function call($function, ...$arguments)
    {
        if (in_array($function, array_keys($this->functions))) {
            return $this->functions[$function](...$arguments);
        }

        throw new \Exception('No function named "' . $function . '" defined for collections !');
    }

}