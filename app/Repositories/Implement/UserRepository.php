<?php
/**
 * Created by PhpStorm.
 * User: tit
 * Date: 28/03/19
 * Time: 10:56
 */

namespace App\Repositories\Implement;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{

    public function model()
    {
        return User::class;
    }
}