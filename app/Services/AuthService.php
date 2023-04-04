<?php

namespace App\Services;

use App\Repositories\UsersRepositories\UsersRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    private UsersRepository $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new UsersRepository();
    }

    public function register(array $data): int
    {
        $data['password'] = Hash::make($data['password']);

        return $this->usersRepository->create($data);
    }

    public function createRecoveringToken(string $email): bool
    {
        $recoverCode = Str::random(32);
        $user = $this->usersRepository->getByEmail($email);
        if ($this->usersRepository->update($user->id, ['recovering_token' => $recoverCode])) {
            mail($user->email, 'Recover password', $recoverCode);
            return true;
        }

        throw new \Exception('Failed to update user');
    }

    public function updatePassword(string $recoveringToken, string $password): bool
    {
        $user = $this->usersRepository->getByRecoveringToken($recoveringToken);
        if ($this->usersRepository->update($user->id, ['password' => Hash::make($password)])) {
            return true;
        }

        throw new \Exception('Failed to update user');
    }


}
