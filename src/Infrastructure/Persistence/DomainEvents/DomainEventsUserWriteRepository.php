<?php

declare(strict_types=1);

namespace Kata\Infrastructure\Persistence\DomainEvents;

use Kata\Domain\User;
use Kata\Domain\UserWasCreated;
use Kata\Domain\UserWriteRepository;

class DomainEventsUserWriteRepository implements UserWriteRepository
{
    protected array $users;

    public function __construct()
    {
        $this->users = [];
    }

    public function persist(User $user)
    {
        foreach ($user->events() as $event) {
            if($event instanceof UserWasCreated) {
                $this->users[] = $user;
            }
        }
    }
}