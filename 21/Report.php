<?php
interface ReportDataSource {
    public function fetch(): array;
}

final class ArrayReportDataSource implements ReportDataSource {
    public function __construct(private array $data) {}
    public function fetch(): array { return $this->data; }
}

interface ReportFormatter {
    public function format(array $data): string;
}

final class JsonReportFormatter implements ReportFormatter {
    public function format(array $data): string {
        return (string)json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

interface ReportStorage {
    public function save(string $content): void;
}

final class FileReportStorage implements ReportStorage {
    public function __construct(private string $path) {}
    public function save(string $content): void { file_put_contents($this->path, $content); }
}

final class ReportService {
    public function __construct(
        private ReportDataSource $source,
        private ReportFormatter $formatter,
        private ReportStorage $storage
    ) {}

    public function run(): void {
        $data = $this->source->fetch();
        $content = $this->formatter->format($data);
        $this->storage->save($content);
    }
}

final class ReportManager {
    public function __construct(private ReportService $service) {}
    public function generate(): void { $this->service->run(); }
}
