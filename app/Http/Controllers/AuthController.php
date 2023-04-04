<?php

namespace App\Http\Controllers;

use App\Http\Rules\Auth\RecoverRules;
use App\Http\Rules\Auth\RegistrationRules;
use App\Http\Rules\Auth\SendRecoverRules;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ItemNotFoundException;

class AuthController extends Controller
{

    public function registration(Request $request, RegistrationRules $registrationRules, AuthService $authService)
    {
        $validData = $this->validate($request, $registrationRules->rules());
        try {
            $userId = $authService->register($validData);

            return response([], Response::HTTP_CREATED)->json(array_merge($validData, ['id' => $userId]));
        } catch (\Exception $exception) {
            Log::log('error', $exception->getMessage(), $exception->getTrace(),);

            return $this->getErrorResponse();
        }
    }

    public function login()
    {
        try {
            $credentials = request(['email', 'password']);

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        } catch (\Exception $exception) {
            Log::log('error', $exception->getMessage(), $exception->getTrace(),);

            return $this->getErrorResponse();
        }

    }

    public function sendRecover(Request $request, SendRecoverRules $recoverRules, AuthService $authService)
    {
        $validData = $this->validate($request, $recoverRules->rules());
        try {
            $authService->createRecoveringToken($validData['email']);

            return response('', Response::HTTP_CREATED);
        } catch (ItemNotFoundException $exception) {
            return response('', Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            Log::log('error', $exception->getMessage(), $exception->getTrace(),);

            return $this->getErrorResponse();
        }
    }

    public function recover(Request $request, RecoverRules $recoverRules, AuthService $authService)
    {
        $validData = $this->validate($request, $recoverRules->rules());
        try {
            $authService->updatePassword($validData['recovering_token'], $validData['password']);

            return response('', Response::HTTP_RESET_CONTENT);
        } catch (\Exception $exception) {
            Log::log('error', $exception->getMessage(), $exception->getTrace(),);

            return $this->getErrorResponse();
        }
    }
}
