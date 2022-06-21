<?php

declare(strict_types=1);

namespace Kata\Application;

class CreateUserCommand
{
    private string $userName;

    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    public function userName(): string
    {
        return $this->userName;
    }
}