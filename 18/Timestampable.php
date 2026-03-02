<?php
trait Timestampable {
    protected DateTimeImmutable $createdAt;
    protected DateTimeImmutable $updatedAt;

    protected function initTimestamps(): void {
        $now = new DateTimeImmutable();
        $this->createdAt = $now;
        $this->updatedAt = $now;
    }

    public function touch(): void {
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getCreatedAt(): DateTimeImmutable {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable {
        return $this->updatedAt;
    }
}
