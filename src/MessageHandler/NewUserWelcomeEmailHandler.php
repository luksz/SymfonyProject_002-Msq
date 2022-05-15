<?php

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\NewUserWelcomeEmail;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class NewUserWelcomeEmailHandler implements MessageHandlerInterface, CommandHandlerInterface
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(NewUserWelcomeEmail $message)
    {

        $this->userRepository->add(new User(Uuid::v4(), "Lukasz-" . rand(0, 1000)), true);
    }
}
