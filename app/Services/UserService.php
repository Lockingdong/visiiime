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
     * @param User $user
     * @return User
     */
    public function loginWithSocial(User $user): User
    {

    }


    /**
     * @param User $user
     * @return User | null
     */
    public function checkoutUserExist(User $user): ?User
    {
        $user = $this->userRepository->firstBy('email', $user->email);

        return $user;
    }

}
