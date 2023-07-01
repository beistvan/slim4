<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserData;
use DomainException;
use PDO;

/**
 * Repository.
 */
class UsersReaderRepository
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
     * Get users list.
     *
     * @throws DomainException
     *
     * @return UserData The user data  / @return iterable
     */
    public function getUsersList(): iterable
    {
        $sql = "SELECT id, username, first_name, last_name, email FROM users;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_OBJ);

        if (!$rows) {
            throw new DomainException(printf('Users not found!'));
        }

        return $rows;
    }
}
