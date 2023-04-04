<?php

namespace App\Repositories\UsersRepositories;

interface UsersRepositoryInterface
{
    public function create($data): int;

    public function update(int $id, array $data): bool;

    public function getByEmail($email): ?object;

    public function getByRecoveringToken(string $recoveringCode): ?object;
}
