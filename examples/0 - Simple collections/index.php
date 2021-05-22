<?php
declare(strict_types=1);

require __DIR__ . '../../../vendor/autoload.php';

use Ulyssear\Collection;

function main()
{
    dump('NEW INSTANCE');
    $collection = new Collection;
    dump($collection);

    dump('PUSH');
    $collection->push('First', 'Second', 'Third', 'Fourth');
    dump($collection->values());

    dump('POP');
    dump($collection->pop());
    dump($collection->values());

    dump('SHIFT');
    dump($collection->shift());
    dump($collection->values());
}

main();