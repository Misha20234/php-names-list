<?php
class Rectangle {
    protected int $w = 0;
    protected int $h = 0;

    public function setWidth(int $w): void { $this->w = $w; }
    public function setHeight(int $h): void { $this->h = $h; }
    public function area(): int { return $this->w * $this->h; }
}

class Square extends Rectangle {
    public function setWidth(int $w): void { $this->w = $w; $this->h = $w; }
    public function setHeight(int $h): void { $this->w = $h; $this->h = $h; }
}

function resizeRectangle(Rectangle $r): int {
    $r->setWidth(5);
    $r->setHeight(10);
    return $r->area();
}

interface Shape {
    public function area(): int;
}

final class RectShape implements Shape {
    public function __construct(private int $w, private int $h) {}
    public function area(): int { return $this->w * $this->h; }
}

final class SquareShape implements Shape {
    public function __construct(private int $a) {}
    public function area(): int { return $this->a * $this->a; }
}
