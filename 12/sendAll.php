<?php
require_once __DIR__ . '/../11/Notification.php';

function sendAll(array $notifications): void {
    foreach ($notifications as $n) {
        if (!($n instanceof Notification)) {
            throw new InvalidArgumentException('Not a Notification');
        }
        $n->send();
    }
}
