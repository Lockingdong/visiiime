<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;


class UserService extends BaseService
{

    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        parent::__construct($userRepository);
        $this->userRepository = $userRepository;
    }


    /**
     * @param string $email
     * @return User | null
     */
    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->firstBy('email', $email);
    }

}
