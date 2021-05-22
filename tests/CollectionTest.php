<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Ulyssear\Collection;

class CollectionTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(
            Collection::class,
            (new Collection)
        );
    }

}