<?php

namespace App\MessageHandler;

use App\Message\OtherSmsNotification;
use App\Message\SmsNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Exception\RecoverableMessageHandlingException;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Notifier\Message\MessageInterface;

// #[AsMessageHandler(fromTransport: 'async', priority: 10)]
final class SmsNotificationHandler implements MessageHandlerInterface, MessageSubscriberInterface
{
    protected static int $lp = 1;
    protected static int $throwLp = 0;

    public function __invoke(SmsNotification $message)
    {
        if (2 == self::$lp) {
            echo self::$lp;
            self::$throwLp++;
            // throw new UnrecoverableMessageHandlingException("Not replay - ! : " . self::$throwLp);
            // throw new RecoverableMessageHandlingException("Force replay - ! : " . self::$throwLp);
        }
        throw new \Exception("My Error : " . self::$lp++);
    }

    public static function getHandledMessages(): iterable
    {
        // handle this message on __invoke
        yield SmsNotification::class;

        // also handle this message on handleOtherSmsNotification
        yield OtherSmsNotification::class => [
            'method' => 'handleOtherSmsNotification',
            //'priority' => 0,
            //'bus' => 'messenger.bus.default',
        ];
    }

    public function handleOtherSmsNotification(OtherSmsNotification $message)
    {
        // throw new \Exception("Other Handle");

        dump(__METHOD__);
        dump($message->getContent());
        // sleep(5);
        return __METHOD__;
    }
}
