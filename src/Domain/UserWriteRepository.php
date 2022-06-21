<?php

declare(strict_types=1);

namespace Kata\Domain;

interface UserWriteRepository
{
    public function persist(User $user);
}