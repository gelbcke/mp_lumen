<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::with('vehicles')->get();
    }

    public function getUserById($UserId)
    {
        if (!User::find($UserId)) {
            return response()->json(['error' => "The User id {$UserId} doesn't exist"], 404);
        }

        return User::with('vehicles')->findOrFail($UserId);
    }

    public function updateUser($userId, array $newDetails)
    {
        if (!User::find($userId)) {
            return response()->json(['error' => "This User id {$userId} doesn't exist."], 404);
        }

        return User::whereId($userId)->update($newDetails);
    }

    public function deleteUser($userId)
    {
        if (!User::find($userId)) {
            return response()->json(['error' => "The User with {$userId} doesn't exist"], 404);
        }

        User::destroy($userId);
    }
}
