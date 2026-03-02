<?php
abstract class Notification {
    public function __construct(
        protected string $recipient,
        protected string $message
    ) {}

    abstract public function send(): void;
}

final class EmailNotification extends Notification {
    public function send(): void {
        echo 'EMAIL to ' . $this->recipient . ': ' . $this->message . PHP_EOL;
    }
}

final class SmsNotification extends Notification {
    public function send(): void {
        echo 'SMS to ' . $this->recipient . ': ' . $this->message . PHP_EOL;
    }
}
