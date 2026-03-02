<?php
require_once __DIR__ . '/Timestampable.php';

final class Post {
    use Timestampable;

    public function __construct(
        private string $title,
        private string $text
    ) {
        $this->initTimestamps();
    }

    public function update(string $title, string $text): void {
        $this->title = $title;
        $this->text = $text;
        $this->touch();
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getText(): string {
        return $this->text;
    }
}
