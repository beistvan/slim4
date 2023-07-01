<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserUpdaterRepository;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class UserUpdater
{
    /**
     * @var UserUpdaterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserUpdaterRepository $repository The repository
     */
    public function __construct(UserUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Update a user.
     *
     * @param array $data The form data
     *
     * @param int $userId The user ID
     *
     * @return int The new user ID
     */
    public function updateUser(array $data, int $userId): int
    {
        // Input validation
        $this->validateUpdatingUser($data);

        // Update user
        $userId = $this->repository->updateUser($data, $userId);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $userId;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateUpdatingUser(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['username'])) {
            $errors['username'] = 'Input required';
        }

        if (empty($data['email'])) {
            $errors['email'] = 'Input required';
        } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = 'Invalid email address';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}