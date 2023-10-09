<?php


namespace App\Http\Services;


use App\Models\UserSession;

class UserSessionService
{
    /**
     * create access_token
     *
     * @param int $id
     * @param string $accessToken
     */
    public function createSession(int $id, string $accessToken)
    {
        UserSession::query()
            ->create(['user_id' => $id, 'access_token' => $accessToken]);
    }

    /**
     * update access_token
     *
     * @param int $id
     * @param string $accessToken
     */
    public function updateSession(int $id, string $accessToken)
    {
        UserSession::query()
            ->where('user_id', $id)
            ->update(['access_token' => $accessToken]);
    }
}
