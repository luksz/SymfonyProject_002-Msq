<?php

namespace App\Message;

final class OtherSmsNotification
{

    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }


    public function getContent(): string
    {
        return $this->content;
    }
}
