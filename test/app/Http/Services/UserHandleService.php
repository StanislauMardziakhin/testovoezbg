<?php


namespace App\Http\Services;


use App\Models\User;

class UserHandleService
{
    /**
     * check if user exist
     *
     * @param int $id
     * @return bool
     */
    public function isUserExist(int $id): bool
    {
        return User::query()
            ->where('id', $id)
            ->exists();
    }

    /**
     * update user
     *
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $city
     * @param string $country
     * @return User
     */
    public function userUpdate(int $id, string $firstName, string $lastName, string $city, string $country): User
    {
        User::query()
            ->where('id', $id)
            ->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'city' => $city,
                'country' => $country
            ]);

        return User::query()
            ->where('id', $id)
            ->first();
    }

    /**
     * create user
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $city
     * @param string $country
     * @return User
     */
    public function userCreate(string $firstName, string $lastName, string $city, string $country): User
    {
        return User::query()
            ->create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'city' => $city,
                'country' => $country
            ]);
    }
}
