<?php
interface Parser {
    public function parse(string $input): array;
}

final class JsonParser implements Parser {
    public function parse(string $input): array {
        $data = json_decode($input, true);
        if (!is_array($data)) {
            throw new InvalidArgumentException('Invalid JSON');
        }
        return $data;
    }
}

final class CsvParser implements Parser {
    public function parse(string $input): array {
        $lines = preg_split('/\R/', trim($input));
        if (!$lines || count($lines) === 0) {
            return [];
        }

        $header = str_getcsv(array_shift($lines));
        $out = [];

        foreach ($lines as $line) {
            if (trim($line) === '') {
                continue;
            }
            $row = str_getcsv($line);
            $item = [];
            foreach ($header as $i => $key) {
                $item[$key] = $row[$i] ?? null;
            }
            $out[] = $item;
        }

        return $out;
    }
}

final class ParserFactory {
    public static function make(string $type): Parser {
        $t = trim(mb_strtolower($type, 'UTF-8'));

        if ($t === 'json') {
            return new JsonParser();
        }
        if ($t === 'csv') {
            return new CsvParser();
        }

        throw new InvalidArgumentException('Unknown parser type');
    }
}
