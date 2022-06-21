<?php

declare(strict_types=1);

namespace Kata\Domain;

class UserWasCreated implements DomainEvent
{
    private string $userName;

    private function __construct(string $userName)
    {
        $this->userName = $userName;
    }
    public static function create(string $userName): self
    {
        return new self($userName);
    }

    public function userName(): string
    {
        return $this->userName;
    }
}