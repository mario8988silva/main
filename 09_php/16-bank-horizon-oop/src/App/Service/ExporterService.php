<?php namespace App\Service;

use Exception;

class ExporterService {
    
    public function export(array $data, string $type = 'csv', bool $save = false) {
        $content = match($type) {
            'csv' => $this->csv($data),
            'json' => $this->json($data),
            'pdf' => $this->pdf($data),
            default => throw new Exception("Unsupported export type: $type"),
        };

        if ($save) {
            $filename = '../data/exports/export_' . date('Y-m-d_H-i-s') . '.' . $type;
            file_put_contents($filename, $content);
        }

        return $content;
    }

    private function csv(array $data) {
        $headerLines = [
            'SEP=,',
            implode(',', array_keys($data[0] ?? [])),
        ];

        $lines = array_map(fn($row) => implode(',', array_values($row)), $data);

        $lines = array_merge($headerLines, $lines);
        $content = implode("\n", $lines);

        return $content;
    }

    private function json(array $data) {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    private function pdf(array $data) {
        // For simplicity, we'll just return a placeholder text.
        // In a real application, you'd use a library like TCPDF or FPDF to generate a PDF.
        throw new Exception("PDF export not implemented yet");
    }
}   