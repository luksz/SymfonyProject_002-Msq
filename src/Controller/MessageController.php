<?php

namespace App\Controller;

use App\Message\OtherSmsNotification;
use App\Message\SmsNotification;
use Monolog\Handler\Handler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Notifier\Message\MessageInterface;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(MessageBusInterface $messageBusInterface): Response
    {
        /**
         * @var  Envelope $envelope
         */
        $envelope = $messageBusInterface->dispatch(new OtherSmsNotification("My Text 4"), [
            // new DelayStamp(1000)
        ]);

        $handleStamp = $envelope->last(HandledStamp::class);

        dump($handleStamp);
        dump('-1');
        /**
         * @var HandledStamp $handleStamp
         */
        // dump($handleStamp->getResult());
        dump('-2');
        dump($envelope->all(HandledStamp::class));
        dump('-3');
        dump($envelope->getMessage());
        dump('-4');


        dd('-');
        // $messageBusInterface->dispatch(new Envelope(new OtherSmsNotification("My SMS Notifi")), [
        //     new DelayStamp(1000)
        // ]);

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/NotificationController.php',
            'handlers' => [$envelope->all(HandledStamp::class)]

        ]);
    }
}
