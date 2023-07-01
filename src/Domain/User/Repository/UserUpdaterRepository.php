<?php

namespace App\Domain\User\Repository;

use PDO;

/**
 * Repository.
 */
class UserUpdaterRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Update user row.
     *
     * @param array $user The user
     *
     * @param int $userId The user ID
     *
     * @return int The new ID
     */
    public function updateUser(array $user, int $userId): int
    {
        $row = [
            'username' => $user['username'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'id' => $userId,
        ];

        $sql = "UPDATE users SET
                username=:username,
                first_name=:first_name,
                last_name=:last_name,
                email=:email
                WHERE
                id=:id;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$userId;
    }
}
