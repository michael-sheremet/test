<?php

namespace App\Repositories\UsersRepositories;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\ItemNotFoundException;

class UsersRepository implements UsersRepositoryInterface
{
    const TABLE = 'users';

    public function create($data): int
    {
        return DB::table(self::TABLE)
            ->insertGetId($data);
    }

    public function update(int $id, array $data): bool
    {
        return DB::table(self::TABLE)
            ->where('id', '=', $id)
            ->update($data);
    }

    public function getByEmail($email): ?object
    {
        $user = DB::table(self::TABLE)
            ->where('email', '=', $email)
            ->first();
        if (empty($user)) {
            throw new ItemNotFoundException();
        }

        return $user;
    }

    public function getByRecoveringToken(string $recoveringToken): ?object
    {
        $user = DB::table(self::TABLE)
            ->where('recovering_token', '=', $recoveringToken)
            ->first();
        if (empty($user)) {
            throw new ItemNotFoundException();
        }

        return $user;
    }

}
