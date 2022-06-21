<?php

declare(strict_types=1);

namespace Kata\Application;

use Exception;
use Kata\Domain\User;
use Kata\Domain\UserWriteRepository;

class CreateUserCommandHandler
{
    private UserWriteRepository $userWriteRepository;

    public function __construct(UserWriteRepository $userWriteRepository)
    {
        $this->userWriteRepository = $userWriteRepository;
    }
    public function handle(CreateUserCommand  $createUserCommand): void
    {
        if($createUserCommand->userName() === '') {
            throw new Exception('UserName cannot be empty');
        }
        $this->userWriteRepository->persist(User::create($createUserCommand->userName()));
    }
}