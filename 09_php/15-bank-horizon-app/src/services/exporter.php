<?php

function export(array $data, string $type = 'csv', bool $save = false) {
    
    $content = match($type) {
        'csv' => exportCsv($data),
        'json' => json_encode($data, JSON_PRETTY_PRINT),
        'pdf' => throw new Exception("PDF export not implemented yet"),
        default => throw new Exception("Unsupported export type: $type"),
    };

    if ($save) {
        $filename = '../data/exports/export_' . date('Y-m-d_H-i-s') . '.' . $type;
        file_put_contents($filename, $content);
    }

    return $content;
}

function exportCsv(array $data) {
    $headerLines = [
        'SEP=,',
        implode(',', array_keys($data[0] ?? [])),
    ];

    $lines = array_map(fn($row) => implode(',', array_values($row)), $data);

    $lines = array_merge($headerLines, $lines);
    $content = implode("\n", $lines);

    return $content;
}