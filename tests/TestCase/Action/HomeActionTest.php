<?php

namespace App\Test\TestCase\Action;

use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test.
 */
class HomeActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test.
     *
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testHomeAction(): void
    {
        // Create request with method and url
        $request = $this->createRequest('GET', '/');

        // Make request and fetch response
        $response = $this->app->handle($request);

        // Asserts
        $this->assertSame(200, $response->getStatusCode());
        $this->assertJsonData($response, ["success"=>true]);
        //$result = json_decode($response->getBody(), true);
        //$this->assertSame($result["success"], true);
    }

}
