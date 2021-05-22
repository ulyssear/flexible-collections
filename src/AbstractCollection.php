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
                return $this->functions[$method](...$parameters);
            } catch (\Throwable $throwable) {
                throw new \Exception($throwable);
            }
        }

        try {
            return $this[$method](...$parameters);
        }
        catch(\Throwable $throwable) {
            throw new \Exception('No function named "' . $method . '" defined for collections !');
        }
    }

    public function setFunction(string $name, callable $function)
    {
        $this->functions[$name] = $function;
        return $this;
    }
}