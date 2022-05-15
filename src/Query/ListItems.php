<?php

namespace App\Query;

use Symfony\Component\Messenger\HandleTrait;

class ListItems
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke()
    {
        $result = $this->query(new ListItemsQuery(/* ... */));

        // Do something with the result
        // ...
    }

    // Creating such a method is optional, but allows type-hinting the result
    private function query(ListItemsQuery $query): ListItemsQueryResult
    {
        // $this->handle()
        return $this->handle($query);
    }
}
