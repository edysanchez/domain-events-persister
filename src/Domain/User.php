<?php

declare(strict_types=1);

namespace Kata\Domain;

class User
{
    private string $userName;

    private function __construct(string $userName)
    {
        if($userName === '') {
            throw new \Exception('UserName cannot be empty');
        }

        $this->userName = $userName;
    }

    public static function create(string $userName): self
    {
        return new self($userName);
    }
}