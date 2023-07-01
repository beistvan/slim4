<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UsersReaderRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UsersReader
{
    /**
     * @var UserReaderRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserReaderRepository $repository The repository
     */
    public function __construct(UsersReaderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Read a users list.
     *
     * @throws ValidationException
     *
     * @return UsersData The user data array
     */
    public function getUsersList(): iterable
    {

        $users = $this->repository->getUsersList();

        return $users;
    }
}