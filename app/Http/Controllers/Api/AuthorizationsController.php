<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController;

class AuthorizationsController extends AccessTokenController
{
    // 邮箱或手机号登录
    public function store(ServerRequestInterface $request)
    {
        return $this->issueToken($request)->setStatusCode(201);
    }

    // 刷新 token
    public function update(ServerRequestInterface $request)
    {
        return $this->issueToken($request);
    }

    // 删除 Token
    public function destroy()
    {
        if (auth('api')->check()) {
            auth('api')->user()->token()->revoke();
            return response(null, 204);
        } else {
            throw new AuthenticationException('The token is invalid.');
        }
    }
}
