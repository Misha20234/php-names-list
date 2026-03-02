<?php
final class EventBus {
    private array $subscribers = [];

    public function subscribe(string $event, callable $handler): void {
        $this->subscribers[$event] = $this->subscribers[$event] ?? [];
        $this->subscribers[$event][] = $handler;
    }

    public function publish(string $event, mixed $payload = null): void {
        $handlers = $this->subscribers[$event] ?? [];
        foreach ($handlers as $h) {
            $h($payload);
        }
    }
}
