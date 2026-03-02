<?php
final class SingletonLogger {
    private static ?self $instance = null;
    private string $path = 'singleton.log';

    private function __construct() {}

    public static function instance(): self {
        return self::$instance ??= new self();
    }

    public function setPath(string $path): void {
        $this->path = $path;
    }

    public function log(string $msg): void {
        file_put_contents($this->path, $msg . PHP_EOL, FILE_APPEND);
    }
}

interface LoggerInterface {
    public function info(string $msg): void;
}

final class FileLogger implements LoggerInterface {
    public function __construct(private string $path) {}
    public function info(string $msg): void {
        file_put_contents($this->path, $msg . PHP_EOL, FILE_APPEND);
    }
}

final class DemoService {
    public function __construct(private LoggerInterface $logger) {}
    public function run(): void {
        $this->logger->info('run');
    }
}
