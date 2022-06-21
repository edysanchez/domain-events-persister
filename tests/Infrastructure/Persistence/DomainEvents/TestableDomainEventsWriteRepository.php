<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\DomainEvents;

use Kata\Infrastructure\Persistence\DomainEvents\DomainEventsUserWriteRepository;

class TestableDomainEventsWriteRepository extends DomainEventsUserWriteRepository
{
    public function persistedUsers(): array
    {
        return $this->users;
    }
}