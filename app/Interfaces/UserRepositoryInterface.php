<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById($UserId);
    public function updateUser($UserId, array $newDetails);
    public function deleteUser($UserId);
}
