<?php

namespace App\Repositories\CompaniesRepositories;

interface CompaniesRepositoryInterface
{
    public function createAndAssign(int $userId, array $data): int;

    public function getByUserId(int $userId): ?object;
}
