<?php

namespace App\Action;

use App\Domain\User\Service\UsersReader;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class UsersReadAction
{
    /**
     * @var UsersReader
     */
    private $usersReader;

    /**
     * The constructor.
     *
     * @param UsersReader $usersReader The users reader
     */
    public function __construct(UsersReader $usersReader)
    {
        $this->usersReader = $usersReader;
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

        // Invoke the Domain with inputs and retain the result
        $usersData = $this->usersReader->getUsersList();

        // Transform the result into the JSON representation

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($usersData));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
