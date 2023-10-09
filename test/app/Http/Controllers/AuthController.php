<?php


namespace App\Http\Controllers;

use App\Http\Requests\UserAuthRequest;
use App\Http\Services\UserSessionService;
use App\Http\Services\UserHandleService;
use Illuminate\Support\Arr;

class AuthController
{
    public function user_auth(
        UserAuthRequest $request,
        UserHandleService $userService,
        UserSessionService $sessionService
    )
    {
        $requestData = $request->validated();
        $accessToken = Arr::get($requestData, 'access_token');
        $id = Arr::get($requestData, 'id');
        $firstName = Arr::get($requestData, 'first_name');
        $lastName = Arr::get($requestData, 'last_name');
        $city = Arr::get($requestData, 'city');
        $country = Arr::get($requestData, 'country');


        if ($userService->isUserExist($id)) {
            $user = $userService->userUpdate($id, $firstName, $lastName, $city, $country);
            $sessionService->updateSession($id, $accessToken);
        } else {
            $user = $userService->userCreate($firstName, $lastName, $city, $country);
            $sessionService->createSession($id, $accessToken);
        }

        return response()->json([
            'access_token' => $accessToken,
            'user_info' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'city' => $user->city,
                'country' => $user->country
            ],
            'error' => '',
            'error_key' => ''
        ]);


    }


}



