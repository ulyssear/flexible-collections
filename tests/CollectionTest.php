<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Ulyssear\Collection;

class CollectionTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(Collection::class, new Collection);
    }

    public function testCanGet(): void
    {
        $collection = new Collection;
        $collection->push('PHP');
        $this->assertEquals('PHP', $collection->get(0));
    }

    public function testCanGetEntries(): void
    {
        $collection = new Collection;
        $collection->push('PHP', 'Composer', 'Ulyssear');
        $this->assertEquals(['PHP', 'Composer', 'Ulyssear'], $collection->entries());
    }

    public function testCanGetKeys(): void
    {
        $collection = new Collection;
        $collection->push('PHP', 'Composer', 'Ulyssear');
        $this->assertEquals([0, 1, 2], $collection->keys());
    }

    public function testCanGetValues(): void
    {
        $collection = new Collection;
        $collection->push('PHP', 'Composer', 'Ulyssear');
        $this->assertEquals(['PHP', 'Composer', 'Ulyssear'], $collection->values());
    }

    public function testCanPushStack(): void
    {
        $collection = new Collection;
        $collection->pushStack(2, 1);
        $this->assertEquals([1, 2], $collection->map);
    }

    public function testCanPushHeap(): void
    {
        $collection = new Collection;
        $collection->pushHeap(1, 2);
        $this->assertEquals([1, 2], $collection->map);
    }

    public function testCanPush(): void
    {
        $collection = new Collection;
        $collection->push('PHP');
        $this->assertEquals(['PHP'], $collection->map);
    }

    public function testCanPushNamedItem(): void
    {
        $collection = new Collection;
        $collection->pushNamedItem('langage', 'PHP');
        $this->assertEquals(['langage' => 'PHP',], $collection->map);
    }

    public function testCanPushNamedItemIfNotExists(): void
    {
        $collection = new Collection;
        $collection->pushNamedItem('langage', 'PHP');
        $collection->pushNamedItemIfNotExists('langage', 'Javascript');
        $this->assertEquals(['langage' => 'PHP',], $collection->map);
    }

    public function testCanPushNamedItems(): void
    {
        $collection = new Collection;
        $collection->pushNamedItems(['langage', 'PHP'], ['plateforme', 'Composer'], ['auteur', 'Ulyssear']);
        $this->assertEquals([
            'langage' => 'PHP',
            'plateforme' => 'Composer',
            'auteur' => 'Ulyssear',
        ], $collection->map);
    }

    public function testCanPushNamedItemsIfNotExists(): void
    {
        $collection = new Collection;
        $collection->pushNamedItems(['langage', 'PHP'], ['plateforme', 'Composer'], ['auteur', 'Ulyssear']);
        $collection->pushNamedItemsIfNotExists(['langage', 'Javascript'], ['plateforme', 'NodeJS'], ['auteur', 'Ulyssear']);
        $this->assertEquals([
            'langage' => 'PHP',
            'plateforme' => 'Composer',
            'auteur' => 'Ulyssear',
        ], $collection->map);
    }

    public function testCanPushIfNotExists(): void
    {
        $collection = new Collection;
        $collection->push(1, 2, 3);
        $collection->pushIfNotExists(2, 4);
        $this->assertEquals([1, 2, 3, 4], $collection->map);
    }

    public function testCanHas(): void
    {
        $collection = new Collection;
        $collection->push('PHP', 'Composer', 'Ulyssear');
        $this->assertTrue($collection->has('Composer'));
    }

    public function testCanHasIndex(): void
    {
        $collection = new Collection;
        $collection->pushNamedItems(['langage', 'PHP'], ['plateforme', 'Composer'], ['auteur', 'Ulyssear']);
        $this->assertTrue($collection->hasIndex('auteur'));
    }

    public function testCanPop(): void
    {
        $collection = new Collection;
        $collection->push(1,2,3);
        $this->assertEquals(3, $collection->pop());
    }

    public function testCanShift(): void
    {
        $collection = new Collection;
        $collection->push(1,2,3);
        $this->assertEquals(1, $collection->shift());
    }

    public function testCanClear(): void
    {
        $collection = new Collection;
        $collection->push(1,2,3)->clear();
        $this->assertEmpty($collection->map);
    }

}