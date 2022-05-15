<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Messenger\Transport\InMemoryTransport;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient([], [
            // 'HTTP_HOST' => 'localhost:8080',
        ]);
        $crawler = $client->request('GET', '/');
        $response = $client->getResponse();
        $content = $response->getContent();
        // dd($content);
        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());

        /**
         * @var InMemoryTransport $transportAsync
         */
        $transportAsync = $this->getContainer()->get('messenger.transport.async');
        /**
         * @var InMemoryTransport $transportAsyncHight
         */
        $transportAsyncHight = $this->getContainer()->get('messenger.transport.async_hight');

        $messages = $transportAsyncHight->getSent();
        dump($messages);
        dump($messages[0]->getMessage());
        $this->assertCount(0, $transportAsync->getSent());
        $this->assertCount(1, $transportAsyncHight->getSent());



        $this->assertJson($content);
        $data = json_decode($content, true);
        $this->assertArrayHasKey('message', $data);
        $this->assertStringContainsString('Welcome to your new controller!', $data['message']);
    }
}
