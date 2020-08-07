<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passport\TokenRepository;

class LogoutController extends BaseController
{
    protected $tokenRepository;


    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * Logout user (Revoke the token)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke (Request $request): JsonResponse
    {
        $tokenId = $request->bearerToken();
        $this->tokenRepository->revokeAccessToken($tokenId);
        return $this->sendResponse('empty', 'Successfully logged out');
    }
}
