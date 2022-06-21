<?php

declare(strict_types=1);

namespace Application;

use Exception;
use Kata\Application\CreateUserCommand;
use Kata\Application\CreateUserCommandHandler;
use PHPUnit\Framework\TestCase;

class CreateUserCommandHandlerTest extends TestCase
{
    /** @test */
    public function givenEmptyUserNameShouldThrowException(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('UserName cannot be empty');
        (new CreateUserCommandHandler())->handle(new CreateUserCommand(''));
    }
}