<?php
interface Workable { public function work(): void; }
interface Eatable { public function eat(): void; }
interface Sleepable { public function sleep(): void; }

final class Human implements Workable, Eatable, Sleepable {
    public function work(): void { echo 'work' . PHP_EOL; }
    public function eat(): void { echo 'eat' . PHP_EOL; }
    public function sleep(): void { echo 'sleep' . PHP_EOL; }
}

final class Robot implements Workable {
    public function work(): void { echo 'work' . PHP_EOL; }
}

function doWork(Workable $w): void {
    $w->work();
}
