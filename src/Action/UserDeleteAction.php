<?php

namespace App\Action;

use App\Domain\User\Service\UserDeleter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class UserDeleteAction
{
    /**
     * @var UserDeleter
     */
    private $userDeleter;

    /**
     * The constructor.
     *
     * @param UserDeleter $userDeleter The user reader
     */
    public function __construct(UserDeleter $userDeleter)
    {
        $this->userDeleter = $userDeleter;
    }

    /**
     * Invoke.
     *
     * @param ServerRequestInterface $request The request
     * @param ResponseInterface $response The response
     * @param array $args The route arguments
     *
     * @return ResponseInterface The response
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $args = []
    ): ResponseInterface {
        // Collect input from the HTTP request
        $userId = (int)$args['id'];

        // Invoke the Domain with inputs and retain the result
        $userId = $this->userDeleter->deleteUser($userId);

        // Transform the result into the JSON representation
        $result = [
            'user_id' => $userId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
