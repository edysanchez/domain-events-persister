<?php

declare(strict_types=1);

namespace Application;

use Exception;
use Kata\Application\CreateUserCommand;
use Kata\Application\CreateUserCommandHandler;
use Kata\Domain\User;
use Kata\Domain\UserWriteRepository;
use PHPUnit\Framework\TestCase;

class CreateUserCommandHandlerTest extends TestCase implements UserWriteRepository
{
    private User $persistedUser;

    /** @test */
    public function givenEmptyUserNameShouldThrowException(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('UserName cannot be empty');
        $this->getCreateUserCommandHandler()->handle(new CreateUserCommand(''));
    }

    /** @test */
    public function givenNonEmptyUserNameShouldPersistIt(): void
    {
        $this->getCreateUserCommandHandler()->handle(new CreateUserCommand('UserName'));
        $this->assertNotNull($this->persistedUser);
    }

    /** @test */
    public function givenCorrectUserCreationShouldHaveADomainEvent(): void
    {
        $this->getCreateUserCommandHandler()->handle(new CreateUserCommand('UserName'));
        $this->assertNotNull($this->persistedUser->events());
        $this->assertCount(1, $this->persistedUser->events());
        $this->assertEquals('UserName', $this->persistedUser->events()[0]->userName());
    }

    private function getCreateUserCommandHandler(): CreateUserCommandHandler
    {
        return new CreateUserCommandHandler($this);
    }

    public function persist(User $user)
    {
        $this->persistedUser = $user;
    }
}