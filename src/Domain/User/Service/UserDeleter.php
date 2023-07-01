<?php

namespace App\Domain\User\Service;

use App\Domain\User\Data\UserData;
use App\Domain\User\Repository\UserDeleterRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UserDeleter
{
    /**
     * @var UserDeleterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserDeleterRepository $repository The repository
     */
    public function __construct(UserDeleterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Delete a user by the given user id.
     *
     * @param int $userId The user id
     *
     * @throws ValidationException
     *
     * @return UserData The user data
     */
    public function deleteUser(int $userId): int
    {
        // Validation
        if (empty($userId)) {
            throw new ValidationException('User ID required');
        }

        $userId = $this->repository->deleteUser($userId);

        return $userId;
    }
}