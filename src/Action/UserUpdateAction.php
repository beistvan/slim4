<?php

namespace App\Action;

use App\Domain\User\Service\UserUpdater;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Action
 */
final class UserUpdateAction
{
    /**
     * @var UserUpdater
     */
    private $userUpdater;

    /**
     * The constructor.
     *
     * @param UserUpdater $userUpdater The user updater
     */
    public function __construct(UserUpdater $userUpdater)
    {
        $this->userUpdater = $userUpdater;
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

        // Collect input from the HTTP request
        $data = (array)$request->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $userId = $this->userUpdater->updateUser($data, $userId);

        // Transform the result into the JSON representation
        $result = [
            'user_id' => $userId
        ];

        // Build the HTTP response
        $response->getBody()->write((string)json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}