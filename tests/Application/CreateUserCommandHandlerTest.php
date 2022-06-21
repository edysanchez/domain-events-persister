<?php

declare(strict_types=1);

namespace Tests\Application;

use Exception;
use Kata\Application\CreateUserCommand;
use Kata\Application\CreateUserCommandHandler;
use PHPUnit\Framework\TestCase;
use Tests\Infrastructure\Persistence\DomainEvents\TestableDomainEventsWriteRepository;

class CreateUserCommandHandlerTest extends TestCase
{
    private TestableDomainEventsWriteRepository $userWriteRepository;

    protected function setUp()
    {
        $this->userWriteRepository = new TestableDomainEventsWriteRepository();
    }

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
        $this->assertNotNull($this->userWriteRepository->persistedUsers());
    }

    /** @test */
    public function givenCorrectUserCreationShouldHaveADomainEvent(): void
    {
        $this->getCreateUserCommandHandler()->handle(new CreateUserCommand('UserName'));
        $this->assertNotNull($this->userWriteRepository->persistedUsers()[0]->events());
        $this->assertCount(1, $this->userWriteRepository->persistedUsers()[0]->events());
        $this->assertEquals('UserName', $this->userWriteRepository->persistedUsers()[0]->userName());
    }

    private function getCreateUserCommandHandler(): CreateUserCommandHandler
    {
        return new CreateUserCommandHandler($this->userWriteRepository);
    }

}