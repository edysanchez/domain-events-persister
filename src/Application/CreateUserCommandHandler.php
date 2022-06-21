<?php

declare(strict_types=1);

namespace Kata\Application;

use Exception;

class CreateUserCommandHandler
{
    public function handle(CreateUserCommand  $createUserCommand): void
    {
        throw new Exception('UserName cannot be empty');
    }
}