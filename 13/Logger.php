<?php
interface LoggerInterface {
    public function info(string $msg): void;
    public function error(string $msg): void;
}

final class FileLogger implements LoggerInterface {
    public function __construct(private string $path) {}

    private function write(string $level, string $msg): void {
        $line = date('Y-m-d H:i:s') . ' [' . $level . '] ' . $msg . PHP_EOL;
        file_put_contents($this->path, $line, FILE_APPEND);
    }

    public function info(string $msg): void {
        $this->write('INFO', $msg);
    }

    public function error(string $msg): void {
        $this->write('ERROR', $msg);
    }
}

final class NullLogger implements LoggerInterface {
    public function info(string $msg): void {}
    public function error(string $msg): void {}
}
