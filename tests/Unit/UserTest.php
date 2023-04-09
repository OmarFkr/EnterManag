<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\UserController;
use App\Models\User;

define('data', 'data');

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_index(): void
    {
        $userController = new UserController();
        $userFromIndexJson = $userController->index();
        $userFromIndexNumber = count(json_decode($userFromIndexJson)->{data});

        $userFromDbNumber = count(User::orderBy('id', 'desc')->get());

        $this->assertTrue($userFromIndexNumber == $userFromDbNumber);
    }
}


